<?php

namespace App\Controller\Frontend;

use App\Repository\ContactRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/contact', name: 'app.contact')]
class ContactController extends AbstractController
{
    #[Route('', name: '.index', methods: ['GET'])]
    public function index(ContactRepository $contactRepo): Response
    {
        return $this->render('Frontend/Contact/index.html.twig', [
            'contact' => $contactRepo->findAll(),
        ]);
    }
}
