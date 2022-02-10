<?php

namespace App\Controller\admin;

use App\Entity\Reseaux;
use App\Form\ReseauxType;
use App\Repository\EntrepriseRepository;
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
    public function index(ReseauxRepository $reseauxRepository, EntrepriseRepository $entrepriseRepository): Response
    {
        return $this->render('reseaux/index.html.twig', [
            'reseaux' => $reseauxRepository->findAll(),
            'entreprise' => $entrepriseRepository->find(1),
            'reseaux' => $reseauxRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'reseaux_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, EntrepriseRepository $entrepriseRepository, ReseauxRepository $reseauxRepository): Response
    {
        $reseaux = new Reseaux();
        $form = $this->createForm(ReseauxType::class, $reseaux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $logo = $form->get('logo')->getData();
            $logo_new_name = uniqid() . '.' . $logo->guessExtension();
            $logo->move($this->getParameter('upload_dir'), $logo_new_name);
            $reseaux->setLogo($logo_new_name);

            $entityManager->persist($reseaux);
            $entityManager->flush();

            return $this->redirectToRoute('reseaux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reseaux/new.html.twig', [
            'reseaux' => $reseaux,
            'form' => $form,
            'entreprise' => $entrepriseRepository->find(1),
            'reseaux' => $reseauxRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'reseaux_show', methods: ['GET'])]
    public function show(Reseaux $reseaux, EntrepriseRepository $entrepriseRepository, ReseauxRepository $reseauxRepository): Response
    {
        return $this->render('reseaux/show.html.twig', [
            'reseaux' => $reseaux,
            'entreprise' => $entrepriseRepository->find(1),
            'reseaux' => $reseauxRepository->findAll(),
        ]);
    }

    #[Route('/{id}/edit', name: 'reseaux_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reseaux $reseaux, EntityManagerInterface $entityManager, EntrepriseRepository $entrepriseRepository, ReseauxRepository $reseauxRepository): Response
    {
        $old_name_logo = $reseaux->getLogo();
        $path = $this->getParameter('upload_dir') . $old_name_logo;

        $form = $this->createForm(ReseauxType::class, $reseaux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $logo = $form->get('logo')->getData();
            if ($logo) {
                if (file_exists($path)) {
                    unlink($path);
                }

                $logo_new_name = uniqid() . '.' . $logo->guessExtension();
                $logo->move($this->getParameter('upload_dir'), $logo_new_name);
                $reseaux->setLogo($logo_new_name);
            } else {
                $reseaux->setLogo($old_name_logo);
            }

            $entityManager->flush();

            return $this->redirectToRoute('reseaux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reseaux/edit.html.twig', [
            'reseaux' => $reseaux,
            'form' => $form,
            'entreprise' => $entrepriseRepository->find(1),
            'reseaux' => $reseauxRepository->findAll(),
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
