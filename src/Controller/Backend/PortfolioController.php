<?php

namespace App\Controller\Backend;

use App\Entity\Portfolio;
use App\Form\PortfolioType;
use App\Repository\PortfolioRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/portfolios', name: 'admin.portfolios')]
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
            // 这里一定要要跟vue里的nom一致
            'portfolios' => $this->portfolioRepo->findAllWithRelationInfo(),
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

            $portfolio->setUser($this->getUser());
            $this->portfolioRepo->save($portfolio);

            $this->addFlash('success', 'Portfolio created successfully');

            return $this->redirectToRoute('admin.portfolios.index');
        }

        return $this->render('Backend/Portfolio/create.html.twig', [
            'form' => $form,

        ]);
    }

    // 修改
    #[Route('/{id}/edit', name: '.edit', methods: ['GET', 'POST'])]
    public function edit(?portfolio $portfolio, Request $request): Response
    {
        // On vérifie que l'portfolio est bien trouvé
        if (!$portfolio instanceof Portfolio) {
            $this->addFlash('error', 'portfolio non trouvé');

            return $this->redirectToRoute('admin.articles.index');
        }

        $form = $this->createForm(PortfolioType::class, $portfolio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->portfolioRepo->save($portfolio);

            $this->addFlash('success', 'portfolio mis à jour avec succès');

            return $this->redirectToRoute('admin.portfolios.index');
        }

        return $this->render('Backend/portfolio/edit.html.twig', [
            'form' => $form,
        ]);
    }

    // 删除
    #[Route('/delete', name: '.delete', methods: ['POST'])]
    public function delete(Request $request): RedirectResponse
    {
        $portfolio = $this->portfolioRepo->find($request->get('id', 0));

        if (!$portfolio instanceof Portfolio) {
            $this->addFlash('error', 'portfolio non trouvé');

            return $this->redirectToRoute('admin.articles.index', [], 404);
        }

        if ($this->isCsrfTokenValid('delete' . $portfolio->getId(), $request->get('token'))) {
            $this->portfolioRepo->remove($portfolio);

            $this->addFlash('success', 'portfolio supprimé avec succès');

            return $this->redirectToRoute('admin.portfolios.index');
        }

        $this->addFlash('error', 'Token invalid');

        return $this->redirectToRoute('admin.portfolios.index');
    }
}
