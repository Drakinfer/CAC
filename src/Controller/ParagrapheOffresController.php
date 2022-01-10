<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParagrapheOffresController extends AbstractController
{
    #[Route('/paragraphe/offres', name: 'paragraphe_offres')]
    public function index(): Response
    {
        return $this->render('paragraphe_offres/index.html.twig', [
            'controller_name' => 'ParagrapheOffresController',
        ]);
    }
}
