<?php

namespace App\Controller\Frontend;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

#[Route('/contact', name: 'app.contact')]
class ContactController extends AbstractController
{
    public function __construct(
        private ContactRepository $repo
    ) {
    }

    #[Route('', name: '.index', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->repo->save($contact);
            $this->addFlash('success', 'Contact saved successfully');
            return $this->redirectToRoute('app.contact.validation');
        }


        return $this->render('Frontend/Contact/index.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/validation', name: '.validation', methods: ['GET', 'POST'])]
    public function create(ContactRepository $repo): Response
    {
        return $this->render('Frontend/Contact/validation.html.twig', [
            'contact' => $repo->findAll(),
        ]);
    }
}
