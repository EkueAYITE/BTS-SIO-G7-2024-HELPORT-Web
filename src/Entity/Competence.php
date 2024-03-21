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

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'competences')]
    private Collection $id_user;

    #[ORM\ManyToOne(inversedBy: 'competences')]
    private ?Matiere $id_matiere = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sousMatiere = null;

    #[ORM\ManyToMany(targetEntity: Soutien::class, mappedBy: 'competence')]
    private Collection $soutiens;

    public function __construct()
    {

        $this->id_user = new ArrayCollection();
        $this->soutiens = new ArrayCollection();
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

    /**
     * @return Collection<int, Soutien>
     */
    public function getSoutiens(): Collection
    {
        return $this->soutiens;
    }

    public function addSoutien(Soutien $soutien): static
    {
        if (!$this->soutiens->contains($soutien)) {
            $this->soutiens->add($soutien);
        }

        return $this;
    }

    public function removeSoutien(Soutien $soutien): static
    {
        $this->soutiens->removeElement($soutien);

        return $this;
    }

    public function getSouMatiere(): ?string
    {
        return $this->souMatiere;
    }

    public function setSouMatiere(?string $souMatiere): static
    {
        $this->souMatiere = $souMatiere;

        return $this;
    }

    public function getSousMatiere(): ?string
    {
        return $this->sousMatiere;
    }

    public function setSousMatiere(?string $sousMatiere): static
    {
        $this->sousMatiere = $sousMatiere;

        return $this;
    }
}
