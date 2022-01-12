<?php

namespace App\Controller;

use App\Entity\CategoriesServices;
use App\Form\CategoriesServicesType;
use App\Repository\CategoriesServicesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categories/services')]
class CategoriesServicesController extends AbstractController
{
    #[Route('/', name: 'categories_services_index', methods: ['GET'])]
    public function index(CategoriesServicesRepository $categoriesServicesRepository): Response
    {
        return $this->render('categories_services/index.html.twig', [
            'categories_services' => $categoriesServicesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'categories_services_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categoriesService = new CategoriesServices();
        $form = $this->createForm(CategoriesServicesType::class, $categoriesService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($categoriesService);
            $entityManager->flush();

            return $this->redirectToRoute('categories_services_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categories_services/new.html.twig', [
            'categories_service' => $categoriesService,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'categories_services_show', methods: ['GET'])]
    public function show(CategoriesServices $categoriesService): Response
    {
        return $this->render('categories_services/show.html.twig', [
            'categories_service' => $categoriesService,
        ]);
    }

    #[Route('/{id}/edit', name: 'categories_services_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CategoriesServices $categoriesService, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategoriesServicesType::class, $categoriesService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('categories_services_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categories_services/edit.html.twig', [
            'categories_service' => $categoriesService,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'categories_services_delete', methods: ['POST'])]
    public function delete(Request $request, CategoriesServices $categoriesService, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categoriesService->getId(), $request->request->get('_token'))) {
            $entityManager->remove($categoriesService);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categories_services_index', [], Response::HTTP_SEE_OTHER);
    }
}
