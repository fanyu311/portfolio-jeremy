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

    // 修改   '/{id}/edit'->parametre url
    #[Route('/{id}/edit', name: '.edit', methods: ['GET', 'POST'])]
    // soit nul soit une entity de portfolio -> parametre converteur,si il a trouve pas c'est nul
    public function edit(?portfolio $portfolio, Request $request): Response
    {
        // On vérifie que portfolio est bien trouvé
        // instanceof -> ma variable est ce que instance de la portfolio
        if (!$portfolio instanceof Portfolio) {
            $this->addFlash('error', 'portfolio non trouvé');

            return $this->redirectToRoute('admin.portfolios.index');
        }

        // namespace entirer et le clss entier 
        $form = $this->createForm(PortfolioType::class, $portfolio);
        // toute la requet http de navigateur ->verifier le formulaire etait soumise
        $form->handleRequest($request);

        // validation
        // if formulaire soumis et valide 
        if ($form->isSubmitted() && $form->isValid()) {
            // envoyer portfolio a base de donnee 
            $this->portfolioRepo->save($portfolio);

            $this->addFlash('success', 'portfolio mis à jour avec succès');

            return $this->redirectToRoute('admin.portfolios.index');
        }

        return $this->render('Backend/portfolio/edit.html.twig', [
            'form' => $form,
        ]);
    }

    // 删除
    //RedirectResponse-> supprimer le portfolio directe ,n'y a pas de page  -> une redirect 
    // pas de id car recuperer dans le form 
    // que le post ,pas envie les autres recuperer 
    #[Route('/delete', name: '.delete', methods: ['POST'])]
    public function delete(Request $request): RedirectResponse
    {
        //1. trouver id 
        // request recupere l'id ->post 
        // soit trouver soit 0 ,get(if faut nombre entrier )
        $portfolio = $this->portfolioRepo->find($request->get('id', 0));

        // 2.est ce aue instance dans le portfolio 
        if (!$portfolio instanceof Portfolio) {
            $this->addFlash('error', 'portfolio non trouvé');

            return $this->redirectToRoute('admin.articles.index', [], 404);
        }

        // 3.verifier le token 
        if ($this->isCsrfTokenValid('delete' . $portfolio->getId(), $request->get('token'))) {
            $this->portfolioRepo->remove($portfolio);

            $this->addFlash('success', 'portfolio supprimé avec succès');

            return $this->redirectToRoute('admin.portfolios.index');
        }

        // si vient de cette etap -> ni id ni produit ni token 
        $this->addFlash('error', 'Token invalid');

        return $this->redirectToRoute('admin.portfolios.index');
    }
}
