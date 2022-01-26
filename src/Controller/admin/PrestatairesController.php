<?php

namespace App\Controller\admin;

use App\Entity\Prestataires;
use App\Form\PrestatairesType;
use App\Repository\PrestatairesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/prestataires')]
class PrestatairesController extends AbstractController
{
    #[Route('/', name: 'prestataires_index', methods: ['GET'])]
    public function index(PrestatairesRepository $prestatairesRepository): Response
    {
        return $this->render('prestataires/index.html.twig', [
            'prestataires' => $prestatairesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'prestataires_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $prestataire = new Prestataires();
        $form = $this->createForm(PrestatairesType::class, $prestataire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($prestataire);
            $entityManager->flush();

            return $this->redirectToRoute('prestataires_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('prestataires/new.html.twig', [
            'prestataire' => $prestataire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'prestataires_show', methods: ['GET'])]
    public function show(Prestataires $prestataire): Response
    {
        return $this->render('prestataires/show.html.twig', [
            'prestataire' => $prestataire,
        ]);
    }

    #[Route('/{id}/edit', name: 'prestataires_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Prestataires $prestataire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PrestatairesType::class, $prestataire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('prestataires_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('prestataires/edit.html.twig', [
            'prestataire' => $prestataire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'prestataires_delete', methods: ['POST'])]
    public function delete(Request $request, Prestataires $prestataire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $prestataire->getId(), $request->request->get('_token'))) {
            $entityManager->remove($prestataire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('prestataires_index', [], Response::HTTP_SEE_OTHER);
    }
}
