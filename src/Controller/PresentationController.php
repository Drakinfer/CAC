<?php

namespace App\Controller;

use App\Repository\EntrepriseRepository;
use App\Repository\DescriptionRepository;
use App\Repository\EquipeRepository;
use App\Repository\ReseauxRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PresentationController extends AbstractController
{
    #[Route('/presentation', name: 'presentation')]
    public function index(EntrepriseRepository $entrepriseRepository, DescriptionRepository $descriptionRepository, EquipeRepository $equipeRepository, ReseauxRepository $reseauxRepository): Response
    {

        return $this->render('presentation/index.html.twig', [
            'entreprise' => $entrepriseRepository->find(1),
            'description' => $descriptionRepository->triPosition(),
            'equipes' => $equipeRepository->findAll(),
            'reseaux' => $reseauxRepository->findAll(),
        ]);
    }
}
