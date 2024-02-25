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
    private ?Transport $idmoyentransport = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?User $id_livreur = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Article $id_article = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdmoyentransport(): ?Transport
    {
        return $this->idmoyentransport;
    }

    public function setIdmoyentransport(?Transport $idmoyentransport): static
    {
        $this->idmoyentransport = $idmoyentransport;

        return $this;
    }

    public function getIdLivreur(): ?User
    {
        return $this->id_livreur;
    }

    public function setIdLivreur(?User $id_livreur): static
    {
        $this->id_livreur = $id_livreur;

        return $this;
    }

    public function getIdArticle(): ?Article
    {
        return $this->id_article;
    }

    public function setIdArticle(?Article $id_article): static
    {
        $this->id_article = $id_article;

        return $this;
    }
}
