<?php

namespace App\Entity;

use App\Repository\CompetenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompetenceRepository::class)]
class Competence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $statut = null;

    #[ORM\ManyToMany(targetEntity: Soutien::class, inversedBy: 'competences')]
    private Collection $id_competence;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'competences')]
    private Collection $id_user;

    #[ORM\ManyToOne(inversedBy: 'competences')]
    private ?Matiere $id_matiere = null;

    public function __construct()
    {
        $this->id_competence = new ArrayCollection();
        $this->id_user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection<int, Soutien>
     */
    public function getIdCompetence(): Collection
    {
        return $this->id_competence;
    }

    public function addIdCompetence(Soutien $idCompetence): static
    {
        if (!$this->id_competence->contains($idCompetence)) {
            $this->id_competence->add($idCompetence);
        }

        return $this;
    }

    public function removeIdCompetence(Soutien $idCompetence): static
    {
        $this->id_competence->removeElement($idCompetence);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getIdUser(): Collection
    {
        return $this->id_user;
    }

    public function addIdUser(User $idUser): static
    {
        if (!$this->id_user->contains($idUser)) {
            $this->id_user->add($idUser);
        }

        return $this;
    }

    public function removeIdUser(User $idUser): static
    {
        $this->id_user->removeElement($idUser);

        return $this;
    }

    public function getIdMatiere(): ?Matiere
    {
        return $this->id_matiere;
    }

    public function setIdMatiere(?Matiere $id_matiere): static
    {
        $this->id_matiere = $id_matiere;

        return $this;
    }
}
