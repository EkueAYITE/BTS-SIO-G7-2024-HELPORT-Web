<?php

namespace App\Entity;

use App\Repository\MatiereRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatiereRepository::class)]
class Matiere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private ?string $designation = null;

    #[ORM\Column]
    private ?int $code = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $sous_matiere = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): static
    {
        $this->designation = $designation;

        return $this;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getSousMatiere(): ?string
    {
        return $this->sous_matiere;
    }

    public function setSousMatiere(string $sous_matiere): static
    {
        $this->sous_matiere = $sous_matiere;

        return $this;
    }
}
