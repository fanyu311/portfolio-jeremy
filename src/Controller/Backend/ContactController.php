<?php

namespace App\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/contact', name: 'admin.contact')]
class ContactController extends AbstractController
{
    #[Route('', name: '.index', methods: ['GET', 'POST'])]
    public function index(): Response
    {
        return $this->render('Backend/Contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }
}
