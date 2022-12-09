<?php

namespace App\Controller\back;

use App\Repository\ArtistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/admin')]
class ArtistController extends AbstractController
{
    #[Route('/artist
    ', name: 'app_artist')]
    public function displayAllArtists(ArtistRepository $artistRepository): Response
    {
        return $this->render('back/artist/index.html.twig', [
            'artists' => $artistRepository->findAll(),
        ]);
    }
}
