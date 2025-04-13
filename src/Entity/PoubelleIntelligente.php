<?php

// src/Entity/PoubelleIntelligente.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: 'App\Repository\PoubelleIntelligenteRepository')]
#[ORM\Table(name: 'poubelle_intelligente')]
class PoubelleIntelligente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private string $type_dechets;

    #[ORM\Column(type: 'float')]
    #[Assert\NotBlank]
    #[Assert\Range(min: 0, max: 100)]
    private float $niveau_remplissage;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Length(max: 255)]
    private ?string $localisation = null;

    #[ORM\Column(type: 'float')]
    #[Assert\NotBlank]
    private float $latitude;

    #[ORM\Column(type: 'float')]
    #[Assert\NotBlank]
    private float $longitude;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank]
    private int $zoneId;

    public function __construct()
    {
    }

    // Factory method to match your Java constructor
    public static function create(
        int $id,
        string $type_dechets,
        float $niveau_remplissage,
        ?string $localisation,
        float $latitude,
        float $longitude,
        int $zoneId
    ): self {
        $entity = new self();
        $entity->id = $id;
        $entity->type_dechets = $type_dechets;
        $entity->niveau_remplissage = $niveau_remplissage;
        $entity->localisation = $localisation;
        $entity->latitude = $latitude;
        $entity->longitude = $longitude;
        $entity->zoneId = $zoneId;
        return $entity;
    }

    // Getters and Setters
    public function getId(): ?int { return $this->id; }
    public function setId(int $id): self { $this->id = $id; return $this; }

    public function getTypeDechets(): string { return $this->type_dechets; }
    public function setTypeDechets(string $type_dechets): self { $this->type_dechets = $type_dechets; return $this; }

    public function getNiveauRemplissage(): float { return $this->niveau_remplissage; }
    public function setNiveauRemplissage(float $niveau_remplissage): self { $this->niveau_remplissage = $niveau_remplissage; return $this; }

    public function getLocalisation(): ?string { return $this->localisation; }
    public function setLocalisation(?string $localisation): self { $this->localisation = $localisation; return $this; }

    public function getLatitude(): float { return $this->latitude; }
    public function setLatitude(float $latitude): self { $this->latitude = $latitude; return $this; }

    public function getLongitude(): float { return $this->longitude; }
    public function setLongitude(float $longitude): self { $this->longitude = $longitude; return $this; }

    public function getZoneId(): int { return $this->zoneId; }
    public function setZoneId(int $zoneId): self { $this->zoneId = $zoneId; return $this; }

    public function extractCoordinatesFromLocalisation(): void
    {
        if ($this->localisation !== null && str_contains($this->localisation, ',')) {
            $parts = explode(',', $this->localisation, 2);
            if (count($parts) === 2) {
                $this->latitude = (float)trim($parts[0]);
                $this->longitude = (float)trim($parts[1]);
            }
        }
    }
}