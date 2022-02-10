<?php

namespace App\Controller;

use App\Repository\EntrepriseRepository;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PrestatairesRepository;
use App\Repository\ReseauxRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServiceAnnexeController extends AbstractController
{
    #[Route('/service_annexe', name: 'service_annexe')]
    public function index(PrestatairesRepository $prestatairesRepository, EntrepriseRepository $entrepriseRepository, ReseauxRepository $reseauxRepository): Response
    {
        return $this->render('service_annexe/index.html.twig', [
            'prestataires' => $prestatairesRepository->triPosition(),
            'entreprise' => $entrepriseRepository->find(1),
            'reseaux' => $reseauxRepository->findAll(),
        ]);
    }
}
