<?php

namespace App\Controller;

use App\Repository\EntrepriseRepository;
use App\Repository\ReseauxRepository;
use App\Repository\ServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceEntrepriseController extends AbstractController
{
    #[Route('/service/entreprise', name: 'service_entreprise')]
    public function index(EntrepriseRepository $entrepriseRepository, ReseauxRepository $reseauxRepository, ServicesRepository $servicesRepository): Response
    {
        return $this->render('service_entreprise/index.html.twig', [
            'service' => $servicesRepository->TriEntreprises(),
            'reseaux' => $reseauxRepository->findAll(),
            'entreprise' => $entrepriseRepository->find(1),
        ]);
    }
}
