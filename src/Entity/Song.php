<?php

namespace App\Entity;

use App\Repository\SongRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use PHPUnit\Util\Json;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SongRepository::class)]
class Song
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\ManyToMany(targetEntity: Album::class, mappedBy: 'songs')]
    private Collection $albums;

    #[ORM\ManyToMany(targetEntity: Style::class, mappedBy: 'songs')]
    private Collection $styles;

    #[ORM\ManyToMany(targetEntity: Playlist::class, mappedBy: 'songs')]
    private Collection $playlists;

    #[ORM\ManyToMany(targetEntity: Artist::class, inversedBy: 'songs')]
    private Collection $artists;

    #[Assert\File(maxSize: '10000k',
        mimeTypes: ['audio/mp3', 'audio/mp4'],
        mimeTypesMessage: 'Merci de charger un fichier de type mp3 ou mp4')]
    #[ORM\Column(length: 255)]
    private ?string $pathName = null;

    #[ORM\Column(length: 255)]
    private ?string $duration = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cover = null;


    public function __construct()
    {
        $this->albums = new ArrayCollection();
        $this->styles = new ArrayCollection();
        $this->playlists = new ArrayCollection();
        $this->artists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection<int, Album>
     */
    public function getAlbums(): Collection
    {
        return $this->albums;
    }

    public function addAlbum(Album $album): self
    {
        if (!$this->albums->contains($album)) {
            $this->albums->add($album);
            $album->addSong($this);
        }

        return $this;
    }

    public function removeAlbum(Album $album): self
    {
        if ($this->albums->removeElement($album)) {
            $album->removeSong($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Style>
     */
    public function getStyles(): Collection
    {
        return $this->styles;
    }

    public function addStyle(Style $style): self
    {
        if (!$this->styles->contains($style)) {
            $this->styles->add($style);
            $style->addSong($this);
        }

        return $this;
    }

    public function removeStyle(Style $style): self
    {
        if ($this->styles->removeElement($style)) {
            $style->removeSong($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Playlist>
     */
    public function getPlaylists(): Collection
    {
        return $this->playlists;
    }

    public function addPlaylist(Playlist $playlist): self
    {
        if (!$this->playlists->contains($playlist)) {
            $this->playlists->add($playlist);
            $playlist->addSong($this);
        }

        return $this;
    }

    public function removePlaylist(Playlist $playlist): self
    {
        if ($this->playlists->removeElement($playlist)) {
            $playlist->removeSong($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Artist>
     */
    public function getArtists(): Collection
    {
        return $this->artists;
    }

    public function addArtist(Artist $artist): self
    {
        if (!$this->artists->contains($artist)) {
            $this->artists->add($artist);
        }

        return $this;
    }

    public function removeArtist(Artist $artist): self
    {
        $this->artists->removeElement($artist);

        return $this;
    }

    public function getPathName(): ?string
    {
        return $this->pathName;
    }

    public function setPathName(string $pathName): self
    {
        $this->pathName = $pathName;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

//    public function songToJson($song):object{
//
//        $song = [
//           "name"=> $this->getTitle(),
//           "artist"=> $this->getArtists(),
//            "album"=> $this->getAlbums(),
//            "url"=> $this->getPathName(),
//             ];
//
//        return new JsonResponse($song);
//
//
//    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(?string $cover): self
    {
        $this->cover = $cover;

        return $this;
    }
}
