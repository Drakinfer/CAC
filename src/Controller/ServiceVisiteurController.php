<?php

namespace App\Controller;

use App\Repository\EntrepriseRepository;
use App\Repository\ReseauxRepository;
use App\Repository\ServicesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServiceVisiteurController extends AbstractController
{
    #[Route('/service', name: 'service_visiteur')]
    public function index(ServicesRepository $servicesRepository, EntrepriseRepository $entrepriseRepository, ReseauxRepository $reseauxRepository): Response
    {
        return $this->render('service_visiteur/index.html.twig', [
            'services' => $servicesRepository->findAll(),
            'entreprise' => $entrepriseRepository->find(1),
            'reseaux' => $reseauxRepository->findAll(),
        ]);
    }
}
