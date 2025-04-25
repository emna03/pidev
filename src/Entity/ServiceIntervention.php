<?php

namespace App\Entity;

use App\Repository\ServiceInterventionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceInterventionRepository::class)]
#[ORM\Table(name: "serviceintervention")]  // Ajoute cette ligne pour définir explicitement le nom de la table
class ServiceIntervention
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $nomService = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $typeIntervention = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $zoneIntervention = null;

    // Getters et Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomService(): ?string
    {
        return $this->nomService;
    }

    public function setNomService(string $nomService): self
    {
        $this->nomService = $nomService;

        return $this;
    }

    public function getTypeIntervention(): ?string
    {
        return $this->typeIntervention;
    }

    public function setTypeIntervention(string $typeIntervention): self
    {
        $this->typeIntervention = $typeIntervention;

        return $this;
    }

    public function getZoneIntervention(): ?string
    {
        return $this->zoneIntervention;
    }

    public function setZoneIntervention(string $zoneIntervention): self
    {
        $this->zoneIntervention = $zoneIntervention;

        return $this;
    }
}
