<?php

namespace App\Controller\admin;

use App\Entity\ServiceEquipe;
use App\Form\ServiceEquipeType;
use App\Repository\EntrepriseRepository;
use App\Repository\ServiceEquipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/service/equipe')]
class ServiceEquipeController extends AbstractController
{
    #[Route('/new', name: 'service_equipe_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, EntrepriseRepository $entrepriseRepository): Response
    {
        $serviceEquipe = new ServiceEquipe();
        $form = $this->createForm(ServiceEquipeType::class, $serviceEquipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($serviceEquipe);
            $entityManager->flush();

            return $this->redirectToRoute('equipe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('service_equipe/new.html.twig', [
            'service_equipe' => $serviceEquipe,
            'form' => $form,
            'entreprise' => $entrepriseRepository->find(1),
        ]);
    }

    #[Route('/{id}', name: 'service_equipe_show', methods: ['GET'])]
    public function show(ServiceEquipe $serviceEquipe, EntrepriseRepository $entrepriseRepository): Response
    {
        return $this->render('service_equipe/show.html.twig', [
            'service_equipe' => $serviceEquipe,
            'entreprise' => $entrepriseRepository->find(1),
        ]);
    }

    #[Route('/{id}/edit', name: 'service_equipe_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ServiceEquipe $serviceEquipe, EntityManagerInterface $entityManager, EntrepriseRepository $entrepriseRepository): Response
    {
        $form = $this->createForm(ServiceEquipeType::class, $serviceEquipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('equipe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('service_equipe/edit.html.twig', [
            'service_equipe' => $serviceEquipe,
            'form' => $form,
            'entreprise' => $entrepriseRepository->find(1),
        ]);
    }

    #[Route('/{id}', name: 'service_equipe_delete', methods: ['POST'])]
    public function delete(Request $request, ServiceEquipe $serviceEquipe, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $serviceEquipe->getId(), $request->request->get('_token'))) {
            $entityManager->remove($serviceEquipe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('equipe_index', [], Response::HTTP_SEE_OTHER);
    }
}
