<?php

namespace App\Controller\admin;

use App\Entity\ParagrapheOffres;
use App\Form\ParagrapheOffresType;
use App\Repository\EntrepriseRepository;
use App\Repository\ParagrapheOffresRepository;
use App\Repository\ReseauxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/paragraphe/offres')]
class ParagrapheOffresController extends AbstractController
{
    #[Route('/', name: 'paragraphe_offres_index', methods: ['GET'])]
    public function index(ParagrapheOffresRepository $paragrapheOffresRepository, EntrepriseRepository $entrepriseRepository, ReseauxRepository $reseauxRepository): Response
    {
        return $this->render('paragraphe_offres/index.html.twig', [
            'paragraphe_offres' => $paragrapheOffresRepository->findAll(),
            'entreprise' => $entrepriseRepository->find(1),
            'reseaux' => $reseauxRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'paragraphe_offres_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, EntrepriseRepository $entrepriseRepository, ReseauxRepository $reseauxRepository): Response
    {
        $paragrapheOffre = new ParagrapheOffres();
        $form = $this->createForm(ParagrapheOffresType::class, $paragrapheOffre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($paragrapheOffre);
            $entityManager->flush();

            return $this->redirectToRoute('paragraphe_offres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('paragraphe_offres/new.html.twig', [
            'paragraphe_offre' => $paragrapheOffre,
            'form' => $form,
            'entreprise' => $entrepriseRepository->find(1),
            'reseaux' => $reseauxRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'paragraphe_offres_show', methods: ['GET'])]
    public function show(ParagrapheOffres $paragrapheOffre, EntrepriseRepository $entrepriseRepository, ReseauxRepository $reseauxRepository): Response
    {
        return $this->render('paragraphe_offres/show.html.twig', [
            'paragraphe_offre' => $paragrapheOffre,
            'entreprise' => $entrepriseRepository->find(1),
            'reseaux' => $reseauxRepository->findAll(),
        ]);
    }

    #[Route('/{id}/edit', name: 'paragraphe_offres_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ParagrapheOffres $paragrapheOffre, EntityManagerInterface $entityManager, EntrepriseRepository $entrepriseRepository, ReseauxRepository $reseauxRepository): Response
    {
        $form = $this->createForm(ParagrapheOffresType::class, $paragrapheOffre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('paragraphe_offres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('paragraphe_offres/edit.html.twig', [
            'paragraphe_offre' => $paragrapheOffre,
            'form' => $form,
            'entreprise' => $entrepriseRepository->find(1),
            'reseaux' => $reseauxRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'paragraphe_offres_delete', methods: ['POST'])]
    public function delete(Request $request, ParagrapheOffres $paragrapheOffre, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $paragrapheOffre->getId(), $request->request->get('_token'))) {
            $entityManager->remove($paragrapheOffre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('paragraphe_offres_index', [], Response::HTTP_SEE_OTHER);
    }
}
