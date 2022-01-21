<?php

namespace App\Controller;

use App\Repository\ServicesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServiceVisiteurController extends AbstractController
{
    #[Route('/service', name: 'service_visiteur')] 
    public function index(ServicesRepository $servicesRepository): Response
    {
        return $this->render('service_visiteur/index.html.twig', [
            'services' => $servicesRepository->findAll()
            ]);
    }
}
