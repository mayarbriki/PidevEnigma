<?php

namespace App\Entity;

use App\Repository\TransportRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: TransportRepository::class)]
class Transport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: "Type cannot be blank")]
    #[Assert\Length(max: 255, maxMessage: "Type cannot be longer than {{ limit }} characters")]
    #[Symfony\Component\Form\Extension\Core\Type\ChoiceType(choices: ['Velo' => 'velo', 'Moto' => 'moto', 'Voiture' => 'voiture'])]
    private ?string $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: "Etat cannot be blank")]
    #[Assert\Length(max: 255, maxMessage: "Etat cannot be longer than {{ limit }} characters")]
    #[Symfony\Component\Form\Extension\Core\Type\ChoiceType(choices: ['Disponible' => 'disponible', 'Non-disponible' => 'non-disponible', 'En-livraison' => 'en-livraison'])]
    private ?string $etat = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: "Status cannot be blank")]
    #[Assert\Length(max: 255, maxMessage: "Status cannot be longer than {{ limit }} characters")]
    private ?string $status = null;

    // Getter and setter methods...

    public function getId(): ?int
    {
        return $this->id;
    }

    // Getter and setter methods for type, etat, and status...

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): static
    {
        $this->status = $status;

        return $this;
    }
}
