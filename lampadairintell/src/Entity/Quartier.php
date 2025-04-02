<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: 'App\Repository\QuartierRepository')]
#[ORM\Table(name: 'quartier')]
class Quartier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: 'float', name: 'consomTot')]
    private ?float $consomTot = 0.0;

    private ?int $lampadaireCount = 0; // Property to store lampadaire count

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getConsomTot(): ?float
    {
        return $this->consomTot;
    }

    public function setConsomTot(float $consomTot): self
    {
        $this->consomTot = $consomTot;
        return $this;
    }

    public function getLampadaireCount(): int
    {
        return $this->lampadaireCount ?? 0;
    }

    public function setLampadaireCount(int $count): void
    {
        $this->lampadaireCount = $count;
    }

    public function __toString(): string
    {
        return (string) $this->nom;
    }
}