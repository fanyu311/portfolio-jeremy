<?php

namespace App\Controller\Frontend;

use App\Repository\PortfolioRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class MainControllerPhpController extends AbstractController
{
    #[Route('', name: 'app.homepage', methods: ['GET'])]
    public function index(PortfolioRepository $portfolioRepo): Response
    {
        return $this->render('Frontend/Home/index.html.twig', [
            'portfolio' => $portfolioRepo->findAllWithRelationInfo(),
        ]);
    }
}
