<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $artid = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $artlib = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $artdesc = null;

    #[ORM\Column(nullable: true)]
    private ?int $artdispo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $artimg = null;

    #[ORM\Column(nullable: true)]
    private ?float $artprix = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtid(): ?int
    {
        return $this->artid;
    }

    public function setArtid(?int $artid): static
    {
        $this->artid = $artid;

        return $this;
    }

    public function getArtlib(): ?string
    {
        return $this->artlib;
    }

    public function setArtlib(?string $artlib): static
    {
        $this->artlib = $artlib;

        return $this;
    }

    public function getArtdesc(): ?string
    {
        return $this->artdesc;
    }

    public function setArtdesc(?string $artdesc): static
    {
        $this->artdesc = $artdesc;

        return $this;
    }

    public function getArtdispo(): ?int
    {
        return $this->artdispo;
    }

    public function setArtdispo(?int $artdispo): static
    {
        $this->artdispo = $artdispo;

        return $this;
    }

    public function getArtimg(): ?string
    {
        return $this->artimg;
    }

    public function setArtimg(?string $artimg): static
    {
        $this->artimg = $artimg;

        return $this;
    }

    public function getArtprix(): ?float
    {
        return $this->artprix;
    }

    public function setArtprix(?float $artprix): static
    {
        $this->artprix = $artprix;

        return $this;
    }
}
