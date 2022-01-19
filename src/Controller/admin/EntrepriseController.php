<?php

namespace App\Controller\admin;

use App\Entity\Entreprise;
use App\Form\EntrepriseType;
use App\Repository\DescriptionRepository;
use App\Repository\EntrepriseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/entreprise')]
class EntrepriseController extends AbstractController
{
    #[Route('/{id}/edit', name: 'entreprise_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Entreprise $entreprise, EntityManagerInterface $entityManager, DescriptionRepository $descriptionRepository): Response
    {
        $form = $this->createForm(EntrepriseType::class, $entreprise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('entreprise_edit', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('entreprise/edit.html.twig', [
            'entreprise' => $entreprise,
            'form' => $form,
            'descriptions' => $descriptionRepository->triPosition(),
        ]);
    }
}
