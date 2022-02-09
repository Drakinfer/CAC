<?php

namespace App\Controller\admin;

use App\Entity\Prestataires;
use App\Form\PrestatairesType;
use App\Repository\EntrepriseRepository;
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
    public function index(PrestatairesRepository $prestatairesRepository, EntrepriseRepository $entrepriseRepository): Response
    {
        return $this->render('prestataires/index.html.twig', [
            'prestataires' => $prestatairesRepository->findAll(),
            'entreprise' => $entrepriseRepository->find(1),
        ]);
    }

    #[Route('/new', name: 'prestataires_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, EntrepriseRepository $entrepriseRepository): Response
    {
        $prestataire = new Prestataires();
        $form = $this->createForm(PrestatairesType::class, $prestataire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            $image_new_name = uniqid() . '.' . $image->guessExtension();
            $image->move($this->getParameter('upload_dir'), $image_new_name);
            $prestataire->setImage($image_new_name);

            $entityManager->persist($prestataire);
            $entityManager->flush();

            return $this->redirectToRoute('prestataires_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('prestataires/new.html.twig', [
            'prestataire' => $prestataire,
            'form' => $form,
            'entreprise' => $entrepriseRepository->find(1),
        ]);
    }

    #[Route('/{id}', name: 'prestataires_show', methods: ['GET'])]
    public function show(Prestataires $prestataire, EntrepriseRepository $entrepriseRepository): Response
    {
        return $this->render('prestataires/show.html.twig', [
            'prestataire' => $prestataire,
            'entreprise' => $entrepriseRepository->find(1),
        ]);
    }

    #[Route('/{id}/edit', name: 'prestataires_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Prestataires $prestataire, EntityManagerInterface $entityManager, EntrepriseRepository $entrepriseRepository): Response
    {
        $old_name_image = $prestataire->getImage();
        $path = $this->getParameter('upload_dir') . $old_name_image;
        $form = $this->createForm(PrestatairesType::class, $prestataire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            if ($image) {
                if (file_exists($path)) {
                    unlink($path);
                }

                $image_new_name = uniqid() . '.' . $image->guessExtension();
                $image->move($this->getParameter('upload_dir'), $image_new_name);
                $prestataire->setImage($image_new_name);
            } else {
                $prestataire->setImage($old_name_image);
            }
            $entityManager->flush();

            return $this->redirectToRoute('prestataires_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('prestataires/edit.html.twig', [
            'prestataire' => $prestataire,
            'form' => $form,
            'entreprise' => $entrepriseRepository->find(1),
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
