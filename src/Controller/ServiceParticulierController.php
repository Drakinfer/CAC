<?php

namespace App\Controller;

use App\Entity\Services;
use App\Repository\EntrepriseRepository;
use App\Repository\ReseauxRepository;
use App\Repository\ServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceParticulierController extends AbstractController
{
    #[Route('/service/particulier', name: 'service_particulier')]
    public function index(ServicesRepository $servicesRepository, ReseauxRepository $reseauxRepository, EntrepriseRepository $entrepriseRepository, Services $services): Response
    {
        return $this->render('service_particulier/index.html.twig', [
            'service' => $servicesRepository->TriParticuliers(),
            'reseaux' => $reseauxRepository->findAll(),
            'entreprise' => $entrepriseRepository->find(1),
        ]);
    }
}
