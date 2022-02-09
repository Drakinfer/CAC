<?php

namespace App\Controller\admin;

use App\Entity\Equipe;
use App\Form\EquipeType;
use App\Repository\EntrepriseRepository;
use App\Repository\EquipeRepository;
use App\Repository\ServiceEquipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/equipe')]
class EquipeController extends AbstractController
{
    #[Route('/', name: 'equipe_index', methods: ['GET'])]
    public function index(EquipeRepository $equipeRepository, ServiceEquipeRepository $serviceEquipeRepository, EntrepriseRepository $entrepriseRepository): Response
    {
        return $this->render('equipe/index.html.twig', [
            'equipes' => $equipeRepository->findAll(),
            'service_equipes' => $serviceEquipeRepository->findAll(),
            'entreprise' => $entrepriseRepository->find(1),
        ]);
    }

    #[Route('/new', name: 'equipe_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, EntrepriseRepository $entrepriseRepository): Response
    {
        $equipe = new Equipe();
        $form = $this->createForm(EquipeType::class, $equipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($equipe);
            $entityManager->flush();

            return $this->redirectToRoute('equipe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('equipe/new.html.twig', [
            'equipe' => $equipe,
            'form' => $form,
            'entreprise' => $entrepriseRepository->find(1),
        ]);
    }

    #[Route('/{id}', name: 'equipe_show', methods: ['GET'])]
    public function show(Equipe $equipe, EntrepriseRepository $entrepriseRepository): Response
    {
        return $this->render('equipe/show.html.twig', [
            'equipe' => $equipe,
            'entreprise' => $entrepriseRepository->find(1),
        ]);
    }

    #[Route('/{id}/edit', name: 'equipe_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Equipe $equipe, EntityManagerInterface $entityManager, EntrepriseRepository $entrepriseRepository): Response
    {
        $form = $this->createForm(EquipeType::class, $equipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('equipe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('equipe/edit.html.twig', [
            'equipe' => $equipe,
            'form' => $form,
            'entreprise' => $entrepriseRepository->find(1),
        ]);
    }

    #[Route('/{id}', name: 'equipe_delete', methods: ['POST'])]
    public function delete(Request $request, Equipe $equipe, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $equipe->getId(), $request->request->get('_token'))) {
            $entityManager->remove($equipe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('equipe_index', [], Response::HTTP_SEE_OTHER);
    }
}
