<?php

namespace App\Controller\back;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('admin/user/list', name: 'app_user_list')]
    public function index(UserRepository $userRepository): Response
    {

        return $this->render('dashboard/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }
}
