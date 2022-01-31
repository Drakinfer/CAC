<?php

namespace App\Controller\admin;

use App\Entity\Reseaux;
use App\Form\ReseauxType;
use App\Repository\ReseauxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reseaux')]
class ReseauxController extends AbstractController
{
    #[Route('/', name: 'reseaux_index', methods: ['GET'])]
    public function index(ReseauxRepository $reseauxRepository): Response
    {
        return $this->render('reseaux/index.html.twig', [
            'reseaux' => $reseauxRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'reseaux_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reseaux = new Reseaux();
        $form = $this->createForm(ReseauxType::class, $reseaux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reseaux);
            $entityManager->flush();

            return $this->redirectToRoute('reseaux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reseaux/new.html.twig', [
            'reseaux' => $reseaux,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'reseaux_show', methods: ['GET'])]
    public function show(Reseaux $reseaux): Response
    {
        return $this->render('reseaux/show.html.twig', [
            'reseaux' => $reseaux,
        ]);
    }

    #[Route('/{id}/edit', name: 'reseaux_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reseaux $reseaux, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReseauxType::class, $reseaux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('reseaux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reseaux/edit.html.twig', [
            'reseaux' => $reseaux,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'reseaux_delete', methods: ['POST'])]
    public function delete(Request $request, Reseaux $reseaux, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $reseaux->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reseaux);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reseaux_index', [], Response::HTTP_SEE_OTHER);
    }
}
