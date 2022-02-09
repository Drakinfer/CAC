<?php

namespace App\Controller;

use App\Repository\EntrepriseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MentionsController extends AbstractController
{
    #[Route('/mentions', name: 'mentions')]
    public function index(EntrepriseRepository $entrepriseRepository): Response
    {
        return $this->render('mentions/index.html.twig', [
            'entreprise' => $entrepriseRepository->find(1),
        ]);
    }
}
