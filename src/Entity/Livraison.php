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
}
