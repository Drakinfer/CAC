<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriesServicesController extends AbstractController
{
    #[Route('/categories/services', name: 'categories_services')]
    public function index(): Response
    {
        return $this->render('categories_services/index.html.twig', [
            'controller_name' => 'CategoriesServicesController',
        ]);
    }
}
