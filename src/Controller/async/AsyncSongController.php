<?php

namespace App\Controller\async;

use App\Entity\Album;
use App\Entity\Artist;
use App\Repository\AlbumRepository;
use App\Repository\SongRepository;
use App\Services\SongService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/api')]
class AsyncSongController extends AbstractController
{
    public function __construct(
        private SongRepository $songRepository,
        private SongService $songService,
        private AlbumRepository $albumRepository
    )
    {
    }

    #[Route('/album/{id}', name: 'app_api_songs_by_album')]
    public function byAlbum(Album $album): JsonResponse
    {
        $songs = $this->songService->albumToJson($album);
        return $this->json($songs, 200);
    }

    #[Route('/artist/{id}', name: 'app_api_songs_by_artist')]
    public function byArtist(Artist $artist): JsonResponse
    {
        $songs = $this->songService->artistToJson($artist);
        return $this->json($songs, 200);
    }
}
