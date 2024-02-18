<?php

namespace App\Entity;

use App\Repository\LivraisonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivraisonRepository::class)]
class Livraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Transport $type = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Article $artlib = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Livreur $Nom = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?Transport
    {
        return $this->type;
    }

    public function setType(?Transport $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getArtlib(): ?Article
    {
        return $this->artlib;
    }

    public function setArtlib(?Article $artlib): static
    {
        $this->artlib = $artlib;

        return $this;
    }

    public function getNom(): ?Livreur
    {
        return $this->Nom;
    }

    public function setNom(?Livreur $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }
}
