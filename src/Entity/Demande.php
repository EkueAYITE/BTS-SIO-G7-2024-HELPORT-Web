<?php

namespace App\Entity;

use App\Repository\DemandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'demande', targetEntity: User::class)]
    private Collection $id_user;

    #[ORM\ManyToOne(inversedBy: 'id_demande')]
    private ?Soutien $soutien = null;

    #[ORM\ManyToOne(inversedBy: 'demandes')]
    private ?Matiere $id_matiere = null;

    #[ORM\Column(length: 255)]
    private ?string  $Sous_matiere = null;

    public function __construct()
    {
        $this->id_user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getSousMatiere(): ?string
    {
        return $this->Sous_matiere;
    }

    /**
     * @param string|null $Sous_matiere
     */
    public function setSousMatiere(?string $Sous_matiere): void
    {
        $this->Sous_matiere = $Sous_matiere;
    }

    public function getDateUptaded(): ?\DateTimeInterface
    {
        return $this->date_uptaded;
    }

    public function setDateUpdated(\DateTimeInterface $date_uptaded): static
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
            $idUser->setDemande($this);
        }

        return $this;
    }

    public function removeIdUser(User $idUser): static
    {
        if ($this->id_user->removeElement($idUser)) {
            // set the owning side to null (unless already changed)
            if ($idUser->getDemande() === $this) {
                $idUser->setDemande(null);
            }
        }

        return $this;
    }

    public function getSoutien(): ?Soutien
    {
        return $this->soutien;
    }

    public function setSoutien(?Soutien $soutien): static
    {
        $this->soutien = $soutien;

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
