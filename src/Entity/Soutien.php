<?php

namespace App\Entity;

use App\Repository\SoutienRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SoutienRepository::class)]
class Soutien
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_du_soutien = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_update = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $status = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Demande $demande = null;

    #[ORM\ManyToMany(targetEntity: Competence::class, inversedBy: 'soutiens')]
    private Collection $competence;

    public function __construct()
    {
        $this->competence = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDuSoutien(): ?\DateTimeInterface
    {
        return $this->date_du_soutien;
    }

    public function setDateDuSoutien(\DateTimeInterface $date_du_soutien): static
    {
        $this->date_du_soutien = $date_du_soutien;

        return $this;
    }

    public function getDateUpdate(): ?\DateTimeInterface
    {
        return $this->date_update;
    }

    public function setDateUpdate(\DateTimeInterface $date_update): static
    {
        $this->date_update = $date_update;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getDemande(): ?Demande
    {
        return $this->demande;
    }

    public function setDemande(Demande $demande): static
    {
        $this->demande = $demande;

        return $this;
    }

    /**
     * @return Collection<int, Competence>
     */
    public function getCompetence(): Collection
    {
        return $this->competence;
    }

    public function addCompetence(Competence $competence): static
    {
        if (!$this->competence->contains($competence)) {
            $this->competence->add($competence);
        }

        return $this;
    }

    public function removeCompetence(Competence $competence): static
    {
        $this->competence->removeElement($competence);

        return $this;
    }
}
