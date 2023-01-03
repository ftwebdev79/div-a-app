<?php

namespace App\Controller\front;

use App\Entity\Song;
use App\Repository\AlbumRepository;
use App\Repository\SongRepository;
use App\Services\SongService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;




class SongController extends AbstractController
{


    public function __construct(
        private SongRepository $songRepository,
        private SongService $songService,
        private AlbumRepository $albumRepository
    )
    {
    }

    #[Route('/album/{id}', name: 'app_album_details')]
    public function details(Request $request, string $id): Response
    {
        $album = $this->albumRepository->find($id);

        return $this->render('front/albums/album_details.html.twig', [
            'album' => $album,
        ]);
    }
}
