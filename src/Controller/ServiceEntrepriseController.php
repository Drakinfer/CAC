<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceEntrepriseController extends AbstractController
{
    #[Route('/service/entreprise', name: 'service_entreprise')]
    public function index(): Response
    {
        return $this->render('service_entreprise/index.html.twig', [
            'controller_name' => 'ServiceEntrepriseController',
        ]);
    }
}
