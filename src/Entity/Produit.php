<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"is empty")]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:"is empty")]
    private ?string $description = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"is empty")]
    private ?int $quantite = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"is empty")]
    private ?float $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    private ?Category $Categorys = null;

  
    #[ORM\OneToMany(mappedBy: 'Produit', cascade: ['persist', 'remove'], targetEntity: CommandeProduit::class)]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private Collection $Commande;

    #[ORM\ManyToMany(targetEntity: Panier::class, mappedBy: 'Produits')]
    private Collection $paniers;

   

    

    public function __construct()
    {
        $this->Commande = new ArrayCollection();
        $this->paniers = new ArrayCollection();
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

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

    public function getCategorys(): ?Category
    {
        return $this->Categorys;
    }

    public function setCategorys(?Category $Categorys): self
    {
        $this->Categorys = $Categorys;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->getNom();
        $this->getDescription();
        $this->getQuantite();
        $this->getPrix();
        $this->getImage();
        $this->getCategorys();
    }

    /**
     * @return Collection<int, CommandeProduit>
     */
    public function getCommande(): Collection
    {
        return $this->Commande;
    }
    public function addCommande(CommandeProduit $commande): self
    {
        if (!$this->Commande->contains($commande)) {
            $this->Commande->add($commande);
            $commande->setProduit($this);
        }

        return $this;
    }

    public function removeCommande(CommandeProduit $commande): self
    {
        if ($this->Commande->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getProduit() === $this) {
                $commande->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Panier>
     */
    public function getPaniers(): Collection
    {
        return $this->paniers;
    }

    public function addPanier(Panier $panier): static
    {
        if (!$this->paniers->contains($panier)) {
            $this->paniers->add($panier);
            $panier->addProduit($this);
        }

        return $this;
    }

    public function removePanier(Panier $panier): static
    {
        if ($this->paniers->removeElement($panier)) {
            $panier->removeProduit($this);
        }

        return $this;
    }

    
}
