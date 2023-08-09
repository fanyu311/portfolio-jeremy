<?php

namespace App\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MainControllerPhpController extends AbstractController
{
    #[Route('', name: 'app.homepage', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('Frontend/Home/index.html.twig', [
            'controller_name' => 'MainControllerPhpController',
        ]);
    }
}
