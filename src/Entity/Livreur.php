<?php

namespace App\Entity;

use App\Repository\LivreurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: LivreurRepository::class)]
class Livreur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message:"Nom ne peut pas être vide")]
    #[Assert\Length(max:255, maxMessage: "Nom ne peut pas être plus long que {{ limit }} caractères")]
    private ?string $Nom = null;

    #[ORM\Column(nullable: true)]
    #[Assert\NotBlank(message:"NumeroTel ne peut pas être vide")]
    #[Assert\Regex(pattern:"/^[24579]\d{7}$/", message:"NumeroTel doit comporter 8 chiffres et commencer par 2, 4, 5, 7 ou 9")]
    private ?int $NumeroTel = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message:"Status ne peut pas être vide")]
    #[Symfony\Component\Form\Extension\Core\Type\ChoiceType(choices: ['Disponible' => 'disponible', 'Non-disponible' => 'non-disponible', 'En-livraison' => 'en-livraison'])]
    private ?string $Status = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message:"HistoireLiv ne peut pas être vide")]
    #[Assert\Length(max:255, maxMessage:"HistoireLiv ne peut pas être plus long que {{ limit }} caractères")]
    private ?string $HistoireLiv = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(?string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getNumeroTel(): ?int
    {
        return $this->NumeroTel;
    }

    public function setNumeroTel(?int $NumeroTel): static
    {
        $this->NumeroTel = $NumeroTel;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->Status;
    }

    public function setStatus(?string $Status): static
    {
        $this->Status = $Status;

        return $this;
    }

    public function getHistoireLiv(): ?string
    {
        return $this->HistoireLiv;
    }

    public function setHistoireLiv(?string $HistoireLiv): static
    {
        $this->HistoireLiv = $HistoireLiv;

        return $this;
    }

    public function __toString()
    {
        return $this->getNom();
    }
}
