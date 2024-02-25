<?php

namespace App\Entity;

use App\Repository\StockRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StockRepository::class)]
class Stock
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom_produit = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantite_entre = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantite_sortie = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantite_restante = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'stocks')]
    private ?Fournisseur $Fournisseur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProduit(): ?string
    {
        return $this->nom_produit;
    }

    public function setNomProduit(?string $nom_produit): static
    {
        $this->nom_produit = $nom_produit;

        return $this;
    }

    public function getQuantiteEntre(): ?int
    {
        return $this->quantite_entre;
    }

    public function setQuantiteEntre(?int $quantite_entre): static
    {
        $this->quantite_entre = $quantite_entre;

        return $this;
    }

    public function getQuantiteSortie(): ?int
    {
        return $this->quantite_sortie;
    }

    public function setQuantiteSortie(?int $quantite_sortie): static
    {
        $this->quantite_sortie = $quantite_sortie;

        return $this;
    }

    public function getQuantiteRestante(): ?int
    {
        return $this->quantite_restante;
    }

    public function setQuantiteRestante(?int $quantite_restante): static
    {
        $this->quantite_restante = $quantite_restante;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->Fournisseur;
    }

    public function setFournisseur(?Fournisseur $Fournisseur): static
    {
        $this->Fournisseur = $Fournisseur;

        return $this;
    }
}
