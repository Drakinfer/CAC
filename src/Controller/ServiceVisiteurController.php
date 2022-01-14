<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceVisiteurController extends AbstractController
{
    #[Route('/service/visiteur', name: 'service_visiteur')]
    public function index(): Response
    {
        return $this->render('service_visiteur/index.html.twig', [
            'controller_name' => 'ServiceVisiteurController',
        ]);
    }
}
