<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;  



#[ORM\Entity(repositoryClass: ReclamationRepository::class)]
class Reclamation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
   #[Assert\Length(min: 10, minMessage: "Le titre doit contenir au moins {{ limit }} caractères.")]
    private ?string $titre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    
    private ?\DateTimeInterface $dateR = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(min: 10, minMessage: "La description doit contenir au moins {{ limit }} caractères.")]
    private ?string $descriptionR = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $statusR = null;

    #[ORM\OneToMany(targetEntity: Reponse::class, mappedBy: 'idrec')]
    private Collection $reponse;

    public function __construct()
    {
        $this->reponse = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDateR(): ?\DateTimeInterface
    {
        return $this->dateR;
    }

    public function setDateR(?\DateTimeInterface $dateR): static
    {
        $this->dateR = $dateR;

        return $this;
    }

    public function getDescriptionR(): ?string
    {
        return $this->descriptionR;
    }

    public function setDescriptionR(?string $descriptionR): static
    {
        $this->descriptionR = $descriptionR;

        return $this;
    }

    public function getStatusR(): ?string
    {
        return $this->statusR;
    }

    public function setStatusR(?string $statusR): static
    {
        $this->statusR = $statusR;

        return $this;
    }

    /**
     * @return Collection<int, Reponse
     */
    public function getReponse(): Collection
    {
        return $this->reponse;
    }

    public function addReponse(Reponse $reponse): static
    {
        if (!$this->reponse->contains($reponse)) {
            $this->reponse->add($reponse);
            $reponse->setIdrec($this);
        }

        return $this;
    }

    public function removeReponse(Reponse $reponse): static
    {
        if ($this->reponse->removeElement($reponse)) {
            // set the owning side to null (unless already changed)
            if ($reponse->getIdrec() === $this) {
                $reponse->setIdrec(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        // Return a string representation of the entity, such as its ID or any other relevant property
        return (string) $this->getId();
    }
}
