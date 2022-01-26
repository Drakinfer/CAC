<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PrestatairesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServiceAnnexeController extends AbstractController
{
    #[Route('/service_annexe', name: 'service_annexe')]
    public function index(PrestatairesRepository $prestatairesRepository): Response
    {
        return $this->render('service_annexe/index.html.twig', [
            'prestataires' => $prestatairesRepository->triPosition()
        ]);
    }
}
