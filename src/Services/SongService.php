<?php

namespace App\Services;

use App\Entity\Album;
use App\Entity\Artist;
use App\Entity\Song;

class SongService
{
    /**
     * Converts a Song to a Json Object
     * exploitable by APlayer
     * @param Song $song
     * @return array
     */
    public function songToJson(Song $song): array
    {
        // Getting at least one Cover
        $albums = $song->getAlbums();
        foreach ($albums as $album) {
            $covers[] = $album->getCover();
        }

        return [
            'name' => $song->getTitle(),
            'artist' => $this->getArtistsNames($song),
            'url' => '/mp3/' . $song->getPathname(),
            'cover' => '/images/album/' . $covers[0],
        ];
    }

    public function albumToJson(Album $album): array
    {
        return array_map(fn($song) => $this->songToJson($song), $album->getSongs()->toArray());
    }

    public function artistToJson(Artist $artist): array
    {
        return array_map(fn($song) => $this->songToJson($song), $artist->getSongs()->toArray());
    }

    private function getArtistsNames(Song $song): string
    {
        return join(', ', $song->getArtists()->toArray());
    }


}