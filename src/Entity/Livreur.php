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
    #[Assert\NotBlank(message:"Nom cannot be blank")]
    #[Assert\Length(max:255, maxMessage: "Nom cannot be longer than {{ limit }} characters")]
    private ?string $Nom = null;

    #[ORM\Column(nullable: true)]
    #[Assert\NotBlank(message:"NumeroTel cannot be blank")]
    #[Assert\Regex(pattern:"/^[24579]\d{7}$/", message:"NumeroTel must be 8 digits and start with 2, 4, 5, 7, or 9")]
    private ?int $NumeroTel = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message:"Status cannot be blank")]
    #[Assert\Choice(choices:["disponible", "non-disponible", "en livraison"], message:"Invalid Status")]
    private ?string $Status = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message:"HistoireLiv cannot be blank")]
    #[Assert\Length(max:255, maxMessage:"HistoireLiv cannot be longer than {{ limit }} characters")]
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
