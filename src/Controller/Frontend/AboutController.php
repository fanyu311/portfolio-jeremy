<?php

namespace App\Controller\Frontend;

use App\Entity\About;
use App\Repository\AboutRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/about', name: 'app.about')]
class AboutController extends AbstractController
{
    #[Route('', name: '.index', methods: ['GET'])]
    public function index(AboutRepository $aboutRepo): Response
    {
        return $this->render('Frontend/about/index.html.twig', [
            'about' => $aboutRepo->findAll(),
        ]);
    }
}
