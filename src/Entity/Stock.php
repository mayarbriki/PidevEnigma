<?php

namespace App\Entity;

use App\Repository\StockRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: StockRepository::class)]
class Stock
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(
        min: 2,
        max: 20,
        minMessage: 'Your product name must be at least {{ limit }} characters long',
        maxMessage: 'Your product name cannot be longer than {{ limit }} characters',
    )]
    private ?string $nomProduit = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantite_entre = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantite_sortie = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantite_restante = null;

    #[ORM\Column(type: "date", nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'stocks')]
    private ?Fournisseur $fournisseur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProduit(): ?string
    {
        return $this->nomProduit;
    }
    
    public function setNomProduit(?string $nomProduit): self
    {
        $this->nomProduit = $nomProduit;
    
        return $this;
    }

    public function __toString()
    {
        return $this->id;
    }
    
    public function getQuantiteEntre(): ?int
    {
        return $this->quantite_entre;
    }

    public function setQuantiteEntre(?int $quantite_entre): self
    {
        $this->quantite_entre = $quantite_entre;

        return $this;
    }

    public function getQuantiteSortie(): ?int
    {
        return $this->quantite_sortie;
    }

    public function setQuantiteSortie(?int $quantite_sortie): self
    {
        $this->quantite_sortie = $quantite_sortie;

        return $this;
    }

    public function getQuantiteRestante(): ?int
    {
        return $this->quantite_restante;
    }

    public function setQuantiteRestante(?int $quantite_restante): self
    {
        $this->quantite_restante = $quantite_restante;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

}
