<?php

namespace App\Controller\front;

use App\Repository\ArtistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtistController extends AbstractController
{

    #[Route('/artist/{id}
    ', name: 'app_artist_details')]
    public function details(Request $request, ArtistRepository $artistRepository, string $id): Response
    {
        $artist = $artistRepository->find($id);


        return $this->render('front/artists/artist_details.html.twig', [
            'artist' => $artist
        ]);
    }
}
