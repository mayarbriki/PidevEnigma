<?php

namespace App\Entity;

use App\Repository\LivreurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivreurRepository::class)]
class Livreur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Nom = null;

    #[ORM\Column(nullable: true)]
    private ?int $NumeroTel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Status = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $HistoireLiv = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(?string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getNumeroTel(): ?int
    {
        return $this->NumeroTel;
    }

    public function setNumeroTel(?int $NumeroTel): static
    {
        $this->NumeroTel = $NumeroTel;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->Status;
    }

    public function setStatus(?string $Status): static
    {
        $this->Status = $Status;

        return $this;
    }

    public function getHistoireLiv(): ?string
    {
        return $this->HistoireLiv;
    }

    public function setHistoireLiv(?string $HistoireLiv): static
    {
        $this->HistoireLiv = $HistoireLiv;

        return $this;
    }

    public function __toString()
    {
        return $this->getNom();
    }
}
