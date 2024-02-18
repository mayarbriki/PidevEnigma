<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\PanierRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: PanierRepository::class)]
class Panier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
  
    
    


    #[ORM\OneToOne(inversedBy: 'panier',cascade:['persist','remove'], targetEntity: User::class)]
    private ?User $utilisateur = null;

    #[ORM\ManyToMany(targetEntity: Produit::class, inversedBy: 'paniers')]
    private Collection $Produits;

    public function __construct()
    {
        $this->Produits = new ArrayCollection();
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

   


    /*
     * @return Collection<int, User>
    
    public function getUtilisateur():User 
    {
        return $this->utilisateur;
    }
    public function setUlisateur(?User $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

   public function addUtilisateur(User $utilisateur): self
    {
        if (!$this->utilisateur->contains($utilisateur)) {
            $this->utilisateur->add($utilisateur);
            $utilisateur->setPanier($this);
        }

        return $this;
    }

    public function removeUtilisateur(User $utilisateur): self
    {
        if ($this->utilisateur->removeElement($utilisateur)) {
            // set the owning side to null (unless already changed)
            if ($utilisateur->getPanier() === $this) {
                $utilisateur->setPanier(null);
            }
        }

        return $this;
    }  */

    /**
     * @return Collection<int, Produit>
     */
    public function getProduits(): Collection
    {
        return $this->Produits;
    }

    public function addProduit(Produit $produit): static
    {
        if (!$this->Produits->contains($produit)) {
            $this->Produits->add($produit);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): static
    {
        $this->Produits->removeElement($produit);

        return $this;
    }
}
