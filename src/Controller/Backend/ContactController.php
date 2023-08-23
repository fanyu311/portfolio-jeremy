<?php

namespace App\Controller\Backend;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/contact', name: 'admin.contact')]
class ContactController extends AbstractController
{
    public function __construct(
        private ContactRepository $contactRepo,
    ) {
    }
    #[Route('', name: '.index', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->contactRepo->save($contact);

            $this->addFlash('success', 'Contact is successfully');
            return $this->redirectToRoute("admin.contact.validation");
        }
        return $this->render('Backend/Contact/index.html.twig', [
            'contact' => $contact,
            'form' => $form
        ]);
    }
}
