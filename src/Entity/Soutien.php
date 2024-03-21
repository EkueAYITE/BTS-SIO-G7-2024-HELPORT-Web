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

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $statut = null;

    #[ORM\ManyToMany(targetEntity: Competence::class, mappedBy: 'id_competence')]
    private Collection $competences;

    #[ORM\OneToMany(mappedBy: 'soutien', targetEntity: Demande::class)]
    private Collection $id_demande;

    #[ORM\ManyToOne(inversedBy: 'soutiens')]
    private ?Salle $id_salle = null;

    #[ORM\ManyToMany(targetEntity: Competence::class, mappedBy: 'soutiens')]
    private Collection $id_competence;

    public function __construct()
    {
        $this->competences = new ArrayCollection();
        $this->id_demande = new ArrayCollection();
        $this->id_competence = new ArrayCollection();
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

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getStatut(): ?int
    {
        return $this->statut;
    }

    public function setStatut(int $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection<int, Competence>
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(Competence $competence): static
    {
        if (!$this->competences->contains($competence)) {
            $this->competences->add($competence);
            $competence->addIdCompetence($this);
        }

        return $this;
    }

    public function removeCompetence(Competence $competence): static
    {
        if ($this->competences->removeElement($competence)) {
            $competence->removeIdCompetence($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Demande>
     */
    public function getIdDemande(): Collection
    {
        return $this->id_demande;
    }

    public function addIdDemande(Demande $idDemande): static
    {
        if (!$this->id_demande->contains($idDemande)) {
            $this->id_demande->add($idDemande);
            $idDemande->setSoutien($this);
        }

        return $this;
    }

    public function removeIdDemande(Demande $idDemande): static
    {
        if ($this->id_demande->removeElement($idDemande)) {
            // set the owning side to null (unless already changed)
            if ($idDemande->getSoutien() === $this) {
                $idDemande->setSoutien(null);
            }
        }

        return $this;
    }

    public function getIdSalle(): ?Salle
    {
        return $this->id_salle;
    }

    public function setIdSalle(?Salle $id_salle): static
    {
        $this->id_salle = $id_salle;

        return $this;
    }

    /**
     * @return Collection<int, Competence>
     */
    public function getIdCompetence(): Collection
    {
        return $this->id_competence;
    }

    public function addIdCompetence(Competence $idCompetence): static
    {
        if (!$this->id_competence->contains($idCompetence)) {
            $this->id_competence->add($idCompetence);
            $idCompetence->addSoutien($this);
        }

        return $this;
    }

    public function removeIdCompetence(Competence $idCompetence): static
    {
        if ($this->id_competence->removeElement($idCompetence)) {
            $idCompetence->removeSoutien($this);
        }

        return $this;
    }

}
