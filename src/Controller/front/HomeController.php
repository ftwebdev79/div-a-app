<?php

namespace App\Controller\front;

use App\Repository\AlbumRepository;
use App\Repository\ArtistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('front/home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/user-interface', name: 'app_user_interface')]
    public function interface(AlbumRepository $albumRepository,
    ArtistRepository $artistRepository): Response
    {

        return $this->render('front/home/user-interface.html.twig', [
            'albums' => $albumRepository->displayLastAlbumsReleased(),
            'artists'=> $artistRepository->displayLastArtistAdded()
        ]);
    }
}
