<?php
// src/Entity/Lampadaire.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;

#[ORM\Entity]
#[ORM\Table(name: 'lampadaire')]
class Lampadaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $localisation;

    #[ORM\Column(type: 'boolean')]
    private $etat;

    #[ORM\Column(type: 'float')]
    private $consommation;

    #[ORM\Column(name: 'id_quartier', type: 'integer')]
    private $idQuartier;

    #[ORM\Column(name: 'date_installation', type: 'date')]
    private $dateInstallation;

    // Default constructor
    public function __construct()
    {
    }

    // Getters and Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;
        return $this;
    }

    public function isEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;
        return $this;
    }

    public function getConsommation(): ?float
    {
        return $this->consommation;
    }

    public function setConsommation(float $consommation): self
    {
        $this->consommation = $consommation;
        return $this;
    }

    public function getIdQuartier(): ?int
    {
        return $this->idQuartier;
    }

    public function setIdQuartier(int $idQuartier): self
    {
        $this->idQuartier = $idQuartier;
        return $this;
    }

    public function getDateInstallation(): ?\DateTimeInterface
    {
        return $this->dateInstallation;
    }

    public function setDateInstallation(\DateTimeInterface $dateInstallation): self
    {
        $this->dateInstallation = $dateInstallation;
        return $this;
    }

    public function __toString(): string
    {
        return sprintf(
            'Lampadaire{id=%d, localisation="%s", etat=%s, consommation=%.2f, id_quartier=%d, date_installation=%s}',
            $this->id,
            $this->localisation,
            $this->etat ? 'true' : 'false',
            $this->consommation,
            $this->idQuartier,
            $this->dateInstallation ? $this->dateInstallation->format('Y-m-d') : 'null'
        );
    }
}