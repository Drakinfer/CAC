<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceParticulierController extends AbstractController
{
    #[Route('/service/particulier', name: 'service_particulier')]
    public function index(): Response
    {
        return $this->render('service_particulier/index.html.twig', [
            'controller_name' => 'ServiceParticulierController',
        ]);
    }
}
