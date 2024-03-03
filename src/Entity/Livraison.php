<?php

namespace App\Entity;

use App\Repository\LivraisonRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: LivraisonRepository::class)]
class Livraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Commande $reference = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Transport $matricule = null;

    #[ORM\ManyToOne]
    private ?Livreur $Nom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateLiv = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresseLiv = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $etat = null;

    #[ORM\ManyToOne(inversedBy: 'livraisons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $livreur = null;

    #[ORM\Column( nullable: true)]
    private ?bool $sent = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?Transport
    {
        return $this->matricule;
    }

    public function setMatricule(?Transport $matricule): static
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getReference(): ?Commande
    {
        return $this->reference;
    }

    public function setReference(?Commande $reference): static
    {
        $this->reference = $reference;

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


    public function getDateLiv(): ?\DateTimeInterface
    {
        return $this->dateLiv;
    }

    public function setDateLiv(?\DateTimeInterface $dateLiv): static
    {
        $this->dateLiv = $dateLiv;

        return $this;
    }

    public function getAdresseLiv(): ?string
    {
        return $this->adresseLiv;
    }

    public function setAdresseLiv(?string $adresseLiv): static
    {
        $this->adresseLiv = $adresseLiv;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(?string $etat): static
    {
        $this->etat = $etat;

        return $this;
    }

    public function getLivreur(): ?User
    {
        return $this->livreur;
    }

    public function setLivreur(?User $livreur): static
    {
        $this->livreur = $livreur;

        return $this;
    }

    public function isSent(): ?bool
    {
        return $this->sent;
    }

    public function setSent(bool $sent): static
    {
        $this->sent = $sent;

        return $this;
    }

}
