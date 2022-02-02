<?php

namespace App\Controller\admin;

use App\Entity\ServicePartenaire;
use App\Form\ServicePartenaireType;
use App\Repository\ServicePartenaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/service/partenaire')]
class ServicePartenaireController extends AbstractController
{
    #[Route('/', name: 'service_partenaire_index', methods: ['GET'])]
    public function index(ServicePartenaireRepository $servicePartenaireRepository): Response
    {
        return $this->render('service_partenaire/index.html.twig', [
            'service_partenaires' => $servicePartenaireRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'service_partenaire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $servicePartenaire = new ServicePartenaire();
        $form = $this->createForm(ServicePartenaireType::class, $servicePartenaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($servicePartenaire);
            $entityManager->flush();

            return $this->redirectToRoute('service_partenaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('service_partenaire/new.html.twig', [
            'service_partenaire' => $servicePartenaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'service_partenaire_show', methods: ['GET'])]
    public function show(ServicePartenaire $servicePartenaire): Response
    {
        return $this->render('service_partenaire/show.html.twig', [
            'service_partenaire' => $servicePartenaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'service_partenaire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ServicePartenaire $servicePartenaire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ServicePartenaireType::class, $servicePartenaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('service_partenaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('service_partenaire/edit.html.twig', [
            'service_partenaire' => $servicePartenaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'service_partenaire_delete', methods: ['POST'])]
    public function delete(Request $request, ServicePartenaire $servicePartenaire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$servicePartenaire->getId(), $request->request->get('_token'))) {
            $entityManager->remove($servicePartenaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('service_partenaire_index', [], Response::HTTP_SEE_OTHER);
    }
}
