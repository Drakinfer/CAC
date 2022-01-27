<?php

namespace App\Controller\admin;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/user', name: 'user')]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/{id}/modo', name: 'setModo', methods: ['GET'])]
    public function setModo($id, UserRepository $userRepository)
    {
        $user = $userRepository->find($id);
        $user->setRoles(["ROLE_MODO"]);

        return $this->redirectToRoute('users_index', [], Response::HTTP_SEE_OTHER);
    }
}
