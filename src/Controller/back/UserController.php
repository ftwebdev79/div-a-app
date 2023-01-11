<?php

namespace App\Controller\back;

use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_ADMIN')]
#[Route('/admin')]
class UserController extends AbstractController
{
    #[Route('/user/list', name: 'app_user_list')]
    public function index(UserRepository $userRepository): Response
    {

        return $this->render('dashboard/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('admin/user/update/{id}', name: 'app_user_update')]
    public function update(Request $request,UserRepository $userRepository, EntityManagerInterface $entityManager ,string $id): Response
    {
        $user = $userRepository->find($id);
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->flush();
        }


        return $this->render('back/user/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
