<?php

namespace App\Controller\Backend;

use App\Entity\About;
use App\Form\AboutType;
use App\Repository\AboutRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;

#[Route('/admin/about', name: 'admin.about')]
class AboutController extends AbstractController
{
    public function __construct(
        private AboutRepository $aboutRepo,
    ) {
    }
    #[Route('', name: '.index', methods: ['GET'])]
    public function index(): Response
    {

        return $this->render('Backend/About/index.html.twig', [
            'about' => $this->aboutRepo->findAll(),
        ]);
    }

    #[Route('/create', name: '.create', methods: ['GET', 'POST'])]
    public function create(Request $request): Response
    {
        $about = new About();

        $form = $this->createForm(AboutType::class, $about);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->aboutRepo->save($about);

            $this->addFlash('success', 'Present created');
            return $this->redirectToRoute('admin.about.index');
        }
        return $this->render('Backend/About/create.html.twig', [
            'form' => $form,
        ]);
    }

    // mis a jour formulaire 
    #[Route('/{id}/edit', name: '.edit', methods: ['GET', 'POST'])]
    public function edit(?About $about, Request $request): Response
    {
        // verifier about instance dans le About ou pas 
        if (!$about instanceof About) {
            $this->addFlash('error', 'About no trouvée');

            return  $this->redirectToRoute('admin.about.index');
        }

        // creer nouveau formulaire 
        $form = $this->createForm(AboutType::class, $about);
        $form->handleRequest($request);

        // validation 
        if ($form->isSubmitted() && $form->isValid()) {
            $this->aboutRepo->save($about);
            $this->addFlash('success', 'About mis à jour avec succès');
            return $this->redirectToRoute('admin.about.index');
        }

        return $this->render('Backend/about/edit.html.twig', [
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
        $about = $this->aboutRepo->find($request->get('id', 0));

        // 2.est ce aue instance dans le portfolio 
        if (!$about instanceof About) {
            $this->addFlash('error', 'presentation non trouvé');

            return $this->redirectToRoute('admin.about.index');
        }

        // 3.verifier le token 
        if ($this->isCsrfTokenValid('delete' . $about->getId(), $request->get('token'))) {
            $this->aboutRepo->remove($about);

            $this->addFlash('success', 'presentation supprimé avec succès');

            return $this->redirectToRoute('admin.about.index');
        }

        // si vient de cette etap -> ni id ni produit ni token 
        $this->addFlash('error', 'Token invalid');

        return $this->redirectToRoute('admin.about.index');
    }
}
