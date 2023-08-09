<?php

namespace App\Controller\Backend;

use App\Entity\Portfolio;
use App\Repository\PortfolioRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/portfolio', name: 'admin.portfolio')]
class PortfolioController extends AbstractController
{
    public function __construct(
        private PortfolioRepository $portfolioRepo,
    ) {
    }
    #[Route('', name: '.index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('Backend/Portfolio/index.html.twig', [
            'portfolio' => $this->portfolioRepo->findAllWithRelationInfo(),
        ]);
    }

    // 创建
    #[Route('/create', name: '.create', methods: ['GET', 'POST'])]
    public function create(Request $request): Response
    {
        // 创建新的空的photo
        $portfolio = new Portfolio();

        $form = $this->createForm(PortfolioType::class, $portfolio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->portfolioRepo->save($portfolio);

            $this->addFlash('success', 'Portfolio created successfully');

            return $this->redirectToRoute('admin.portfolio.index');
        }

        return $this->render('Backend/Portfolio/index.html.twig', [
            'form' => $form,
        ]);
    }
}
