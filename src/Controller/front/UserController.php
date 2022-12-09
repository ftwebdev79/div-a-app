<?php

namespace App\Controller\front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/interface', name: 'app_interface')]
    public function index(): Response
    {
        return $this->render('front/home/user-interface.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
