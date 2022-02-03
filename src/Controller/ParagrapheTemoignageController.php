<?php

namespace App\Controller;

use App\Entity\ParagrapheTemoignage;
use App\Form\ParagrapheTemoignageType;
use App\Repository\ParagrapheTemoignageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/paragraphe/temoignage')]
class ParagrapheTemoignageController extends AbstractController
{
    #[Route('/', name: 'paragraphe_temoignage_index', methods: ['GET'])]
    public function index(ParagrapheTemoignageRepository $paragrapheTemoignageRepository): Response
    {
        return $this->render('paragraphe_temoignage/index.html.twig', [
            'paragraphe_temoignages' => $paragrapheTemoignageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'paragraphe_temoignage_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $paragrapheTemoignage = new ParagrapheTemoignage();
        $form = $this->createForm(ParagrapheTemoignageType::class, $paragrapheTemoignage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($paragrapheTemoignage);
            $entityManager->flush();

            return $this->redirectToRoute('paragraphe_temoignage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('paragraphe_temoignage/new.html.twig', [
            'paragraphe_temoignage' => $paragrapheTemoignage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'paragraphe_temoignage_show', methods: ['GET'])]
    public function show(ParagrapheTemoignage $paragrapheTemoignage): Response
    {
        return $this->render('paragraphe_temoignage/show.html.twig', [
            'paragraphe_temoignage' => $paragrapheTemoignage,
        ]);
    }

    #[Route('/{id}/edit', name: 'paragraphe_temoignage_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ParagrapheTemoignage $paragrapheTemoignage, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ParagrapheTemoignageType::class, $paragrapheTemoignage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('paragraphe_temoignage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('paragraphe_temoignage/edit.html.twig', [
            'paragraphe_temoignage' => $paragrapheTemoignage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'paragraphe_temoignage_delete', methods: ['POST'])]
    public function delete(Request $request, ParagrapheTemoignage $paragrapheTemoignage, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$paragrapheTemoignage->getId(), $request->request->get('_token'))) {
            $entityManager->remove($paragrapheTemoignage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('paragraphe_temoignage_index', [], Response::HTTP_SEE_OTHER);
    }
}
