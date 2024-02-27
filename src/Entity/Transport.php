<?php

namespace App\Entity;

use App\Repository\TransportRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: TransportRepository::class)]
class Transport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?User $roles = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: "Type ne peut pas être vide")]
    #[Assert\Length(max: 255, maxMessage: "Type ne peut pas être plus long que {{ limit }} caractères")]
    //#[Symfony\Component\Form\Extension\Core\Type\ChoiceType(choices: ['Velo' => 'velo', 'Moto' => 'moto', 'Voiture' => 'voiture'])]
    private ?string $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: "Etat ne peut pas être vide")]
    #[Assert\Length(max: 255, maxMessage: "Etat ne peut pas être plus long que {{ limit }} caractères")]
    //#[Symfony\Component\Form\Extension\Core\Type\ChoiceType(choices: ['Disponible' => 'disponible', 'Non-disponible' => 'non-disponible', 'En-livraison' => 'en-livraison'])]
    private ?string $marque = null;

    #[ORM\Column(length: 255, nullable: true)]
    //#[Assert\NotBlank(message: "Matricule ne peut pas être vide")]
    //#[Assert\Length(max: 255, maxMessage: "Matricule ne peut pas être plus long que {{ limit }} caractères")]
    //#[Assert\Regex(pattern: '/^\d{3}-TUN-\d{4}$/', message: "Le matricule doit être au format XXX-TUN-XXXX")]
    private ?string $matricule = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $anneefab = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $etat = null;


    public function getId(): ?int
    {
        return $this->id;
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(?string $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    /*public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): static
    {
        $this->status = $status;

        return $this;
    }*/

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(?string $matricule): static
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getAnneefab(): ?\DateTimeImmutable
    {
        return $this->anneefab;
    }

    public function setAnneefab(?\DateTimeInterface $anneefab): self
{
    if ($anneefab instanceof \DateTimeInterface) {
        $this->anneefab = \DateTimeImmutable::createFromMutable($anneefab);
    } else {
        $this->anneefab = null;
    }
    
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
    
    public function __toString()
    {
        return $this->getMatricule();
    }
    
  
}
