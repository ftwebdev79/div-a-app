<?php

namespace App\Controller\front;

use App\Entity\Album;
use App\Form\AlbumType;
use App\Repository\AlbumRepository;
use App\Repository\SongRepository;
use App\Services\SongService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;


class AlbumController extends AbstractController
{


    public function __construct(
        private AlbumRepository       $albumRepository,
        private ParameterBagInterface $parameterBag,
        private SongRepository        $songRepository,
        private SongService           $songService,
    )
    {
    }

    #[
        Route('/album/{id}
    ', name: 'app_album_details')]
    public function details(Request $request, string $id): Response
    {
        $album = $this->albumRepository->find($id);

        dump($this->songService->albumToJson($album));

        return $this->render('front/albums/album_details.html.twig', [
            'album' => $album
        ]);
    }
}
