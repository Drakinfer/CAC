<?php

namespace App\Controller;

use App\Repository\EntrepriseRepository;
use App\Repository\ServicesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServiceEntrepriseController extends AbstractController
{
    #[Route('/service/entreprise', name: 'service_entreprise')]
    public function index(EntrepriseRepository $entrepriseRepository, ServicesRepository $servicesRepository): Response
    {
        return $this->render('service_entreprise/index.html.twig', [
            'services' => $servicesRepository->triEntreprises(),
            'entreprise' => $entrepriseRepository->find(1),
        ]);
    }
}
