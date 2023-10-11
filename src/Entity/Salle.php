<?php

namespace App\Entity;

use App\Repository\SalleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalleRepository::class)]
class Salle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $code_salle = null;

    #[ORM\Column]
    private ?int $etage = null;

    #[ORM\OneToMany(mappedBy: 'id_salle', targetEntity: Soutien::class)]
    private Collection $soutiens;

    public function __construct()
    {
        $this->soutiens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeSalle(): ?string
    {
        return $this->code_salle;
    }

    public function setCodeSalle(string $code_salle): static
    {
        $this->code_salle = $code_salle;

        return $this;
    }

    public function getEtage(): ?int
    {
        return $this->etage;
    }

    public function setEtage(int $etage): static
    {
        $this->etage = $etage;

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
            $soutien->setIdSalle($this);
        }

        return $this;
    }

    public function removeSoutien(Soutien $soutien): static
    {
        if ($this->soutiens->removeElement($soutien)) {
            // set the owning side to null (unless already changed)
            if ($soutien->getIdSalle() === $this) {
                $soutien->setIdSalle(null);
            }
        }

        return $this;
    }
}
