<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtistRepository::class)]
class Artist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $firstReleasedAt = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: Album::class, mappedBy: 'artists')]
    private Collection $albums;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\ManyToMany(targetEntity: Song::class, mappedBy: 'artists')]
    private Collection $songs;

    public function __construct()
    {
        $this->albums = new ArrayCollection();
        $this->songs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }


    public function getFirstReleasedAt(): ?\DateTimeInterface
    {
        return $this->firstReleasedAt;
    }

    public function setFirstReleasedAt(?\DateTimeInterface $firstReleasedAt): self
    {
        $this->firstReleasedAt = $firstReleasedAt;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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
            $album->addArtist($this);
        }

        return $this;
    }

    public function removeAlbum(Album $album): self
    {
        if ($this->albums->removeElement($album)) {
            $album->removeArtist($this);
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = new \DateTime('now');

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }


    public function __toString(): string
    {
       return $this->getName();
    }

    /**
     * @return Collection<int, Song>
     */
    public function getSongs(): Collection
    {
        return $this->songs;
    }

    public function addSong(Song $song): self
    {
        if (!$this->songs->contains($song)) {
            $this->songs->add($song);
            $song->addArtist($this);
        }

        return $this;
    }

    public function removeSong(Song $song): self
    {
        if ($this->songs->removeElement($song)) {
            $song->removeArtist($this);
        }

        return $this;
    }



}
