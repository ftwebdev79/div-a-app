<?php

namespace App\Controller\front;

use App\Repository\ArtistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtistController extends AbstractController
{
    #[Route('/user-interface
    ', name: 'app_artist_interface')]
    public function displayAllArtists(ArtistRepository $artistRepository): Response
    {
        return $this->render('front/home/user-interface.html.twig', [
            'artists' => $artistRepository->findAll(),
        ]);
    }

    #[Route('/artist/{id}
    ', name: 'app_artist_details')]
    public function details(ArtistRepository $artistRepository, string $id): Response
    {
        return $this->render('front/artists/artist_details.html.twig', [
            'artist' => $artistRepository->find($id),
        ]);
    }
}
