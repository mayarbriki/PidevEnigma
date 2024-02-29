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

    #[ORM\ManyToMany(targetEntity: Panier::class, inversedBy: 'produits')]
    private Collection $panier;

    public function __construct()
    {
        $this->panier = new ArrayCollection();
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

    /**
     * @return Collection<int, Panier>
     */
    public function getPanier(): Collection
    {
        return $this->panier;
    }

    public function addPanier(Panier $panier): static
    {
        if (!$this->panier->contains($panier)) {
            $this->panier->add($panier);
        }

        return $this;
    }

    public function removePanier(Panier $panier): static
    {
        $this->panier->removeElement($panier);

        return $this;
    }

   
    
    

     
    

    
    

    
}
