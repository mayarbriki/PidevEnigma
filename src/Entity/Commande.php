<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_creation = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column]
    private ?float $montant = null;

    #[ORM\Column(type: Types::STRING)]
    private ?string $reference = null;

    #[ORM\OneToMany(mappedBy: 'Commande',cascade:['persist','remove'], targetEntity: CommandeProduit::class)]
    private Collection $commandeProduits;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private ?User $utilisateur = null;

    public function __construct()
    {
        $this->date_creation = date_create();
        $this->commandeProduits = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }
    public function setDateCreation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }


    public function getStatus(): ?string
    {
        return $this->status;
    }
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }


    public function getMontant(): ?float
    {
        return $this->montant;
    }
    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }


    public function getReference(): ?string
    {
        return $this->reference;
    }
    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }


    
    /**
     * @return Collection<int, CommandeProduit>
     */
    public function getCommandeProduits(): Collection
    {
        return $this->commandeProduits;
    }

    public function addCommandeProduit(CommandeProduit $commandeProduit): self
    {
        if (!$this->commandeProduits->contains($commandeProduit)) {
            $this->commandeProduits->add($commandeProduit);
            $commandeProduit->setCommande($this);
        }

        return $this;
    }

    public function removeCommandeProduit(CommandeProduit $commandeProduit): self
    {
        if ($this->commandeProduits->removeElement($commandeProduit)) {
            // set the owning side to null (unless already changed)
            if ($commandeProduit->getCommande() === $this) {
                $commandeProduit->setCommande(null);
            }
        }

        return $this;
    }

    public function getUtilisateur(): ?User
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?User $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}
