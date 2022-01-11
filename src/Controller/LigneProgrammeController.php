<?php

namespace App\Controller;

use App\Entity\LigneProgramme;
use App\Form\LigneProgrammeType;
use App\Repository\LigneProgrammeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ligne/programme')]
class LigneProgrammeController extends AbstractController
{
    #[Route('/', name: 'ligne_programme_index', methods: ['GET'])]
    public function index(LigneProgrammeRepository $ligneProgrammeRepository): Response
    {
        return $this->render('ligne_programme/index.html.twig', [
            'ligne_programmes' => $ligneProgrammeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'ligne_programme_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ligneProgramme = new LigneProgramme();
        $form = $this->createForm(LigneProgrammeType::class, $ligneProgramme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ligneProgramme);
            $entityManager->flush();

            return $this->redirectToRoute('ligne_programme_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ligne_programme/new.html.twig', [
            'ligne_programme' => $ligneProgramme,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'ligne_programme_show', methods: ['GET'])]
    public function show(LigneProgramme $ligneProgramme): Response
    {
        return $this->render('ligne_programme/show.html.twig', [
            'ligne_programme' => $ligneProgramme,
        ]);
    }

    #[Route('/{id}/edit', name: 'ligne_programme_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, LigneProgramme $ligneProgramme, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LigneProgrammeType::class, $ligneProgramme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('ligne_programme_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ligne_programme/edit.html.twig', [
            'ligne_programme' => $ligneProgramme,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'ligne_programme_delete', methods: ['POST'])]
    public function delete(Request $request, LigneProgramme $ligneProgramme, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ligneProgramme->getId(), $request->request->get('_token'))) {
            $entityManager->remove($ligneProgramme);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ligne_programme_index', [], Response::HTTP_SEE_OTHER);
    }
}
