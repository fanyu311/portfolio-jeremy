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
    public function __construct(
        private PortfolioRepository $repo,

    ) {
    }

    #[Route('', name: '.index', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $portfolio = new Portfolio();

        $form = $this->createForm(SearchType::class, $portfolio);
        $form->handleRequest($request);

        return $this->render('Frontend/Portfolios/index.html.twig', [
            'portfolio' => $portfolio,
            'form' => $form,
        ]);
    }
}
