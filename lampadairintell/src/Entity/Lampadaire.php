<?php
// src/Entity/Lampadaire.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: 'lampadaire')]
class Lampadaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: "La localisation est obligatoire")]
    #[Assert\Length(
        min: 3,
        max: 255,
        minMessage: "La localisation doit contenir au moins {{ limit }} caractères",
        maxMessage: "La localisation ne peut pas dépasser {{ limit }} caractères"
    )]
    #[Assert\Regex(
        pattern: "/^[a-zA-Z0-9\s\-éèêëàâäôöûüçÉÈÊËÀÂÄÔÖÛÜÇ,.'()]+$/",
        message: "La localisation contient des caractères non autorisés"
    )]
    private $localisation;

    #[ORM\Column(type: 'boolean')]
    #[Assert\NotNull(message: "L'état doit être spécifié (true/false)")]
    private $etat;

    #[ORM\Column(type: 'float')]
    #[Assert\NotBlank(message: "La consommation est obligatoire")]
    #[Assert\Type(type: 'float', message: "La consommation doit être un nombre décimal")]
    #[Assert\Positive(message: "La consommation doit être un nombre positif")]
    #[Assert\LessThan(
        value: 1000,
        message: "La consommation ne peut pas dépasser {{ value }} kWh"
    )]
    private $consommation;

    #[ORM\Column(name: 'id_quartier', type: 'integer')]
    #[Assert\NotBlank(message: "L'ID du quartier est obligatoire")]
    #[Assert\Type(type: 'integer', message: "L'ID du quartier doit être un nombre entier")]
    #[Assert\Positive(message: "L'ID du quartier doit être un nombre positif")]
    private $idQuartier;

    #[ORM\Column(name: 'date_installation', type: 'date')]
    #[Assert\NotBlank(message: "La date d'installation est obligatoire")]
    #[Assert\Type(type: "\DateTimeInterface", message: "La date doit être au format valide")]
    #[Assert\LessThanOrEqual(
        value: "today",
        message: "La date d'installation ne peut pas être dans le futur"
    )]
    #[Assert\GreaterThanOrEqual(
        value: "2000-01-01",
        message: "La date d'installation doit être postérieure au {{ value }}"
    )]
    private $dateInstallation;

    public function __construct()
    {
        // Valeurs par défaut
        $this->etat = false;
        $this->dateInstallation = new \DateTime();
    }

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
        $this->localisation = trim($localisation);
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