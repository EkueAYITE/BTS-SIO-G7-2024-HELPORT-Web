<?php

namespace App\Entity;

use App\Repository\DemandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandeRepository::class)]
class Demande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_uptaded = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_fin_demande = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateUptaded(): ?\DateTimeInterface
    {
        return $this->date_uptaded;
    }

    public function setDateUptaded(\DateTimeInterface $date_uptaded): static
    {
        $this->date_uptaded = $date_uptaded;

        return $this;
    }

    public function getDateFinDemande(): ?\DateTimeInterface
    {
        return $this->date_fin_demande;
    }

    public function setDateFinDemande(\DateTimeInterface $date_fin_demande): static
    {
        $this->date_fin_demande = $date_fin_demande;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }
}
