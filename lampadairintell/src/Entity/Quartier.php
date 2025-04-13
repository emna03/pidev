<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: 'App\Repository\QuartierRepository')]
#[ORM\Table(name: 'quartier')]
class Quartier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: "Le nom du quartier est obligatoire")]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: "Le nom doit contenir au moins {{ limit }} caractères",
        maxMessage: "Le nom ne peut pas dépasser {{ limit }} caractères"
    )]
    #[Assert\Regex(
        pattern: "/^[a-zA-ZÀ-ÿ\s\-'()]+$/",
        message: "Le nom ne peut contenir que des lettres, espaces et caractères spéciaux (-')"
    )]
    private ?string $nom = null;

    #[ORM\Column(type: 'float', name: 'consomTot')]
    #[Assert\NotNull(message: "La consommation totale est obligatoire")]
    #[Assert\Type(type: 'float', message: "La consommation doit être un nombre décimal")]
    #[Assert\PositiveOrZero(message: "La consommation ne peut pas être négative")]
    #[Assert\LessThan(
        value: 1000000,
        message: "La consommation totale ne peut pas dépasser {{ value }} kWh"
    )]
    private ?float $consomTot = 0.0;

    #[Assert\Type(type: 'integer', message: "Le nombre de lampadaires doit être un entier")]
    #[Assert\PositiveOrZero(message: "Le nombre de lampadaires ne peut pas être négatif")]
    private ?int $lampadaireCount = 0;

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
        $this->nom = trim($nom);
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