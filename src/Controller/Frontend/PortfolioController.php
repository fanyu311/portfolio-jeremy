<?php

namespace App\Controller\Frontend;

use App\Entity\Portfolio;
use App\Repository\PortfolioRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/portfolios', name: 'app.portfolios')]
class PortfolioController extends AbstractController
{
    #[Route('', name: '.index', methods: ['GET'])]
    public function index(PortfolioRepository $portfolioRepo): Response
    {
        return $this->render('Frontend/Portfolio/index.html.twig', [
            'portfolios' => $portfolioRepo->findAllWithRelationInfo(),
        ]);
    }
}
