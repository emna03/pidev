<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: 'App\Repository\CamionCollecteRepository')]
#[ORM\Table(name: 'camion_collecte')]
class CamionCollecte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float', name: 'capacite_max')]
    #[Assert\NotBlank(message: "La capacité maximale ne peut pas être vide")]
    #[Assert\Type(type: 'float', message: "La capacité maximale doit être un nombre")]
    #[Assert\Positive(message: "La capacité maximale doit être positive")]
    private $capaciteMax;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank(message: "Le statut ne peut pas être vide")]
    #[Assert\Type(type: 'string', message: "Le statut doit être une chaîne de caractères")]
    #[Assert\Length(
        max: 50,
        maxMessage: "Le statut ne peut pas dépasser {{ limit }} caractères"
    )]
    private $statut;

    #[ORM\Column(type: 'integer', name: 'zone_id')]

    private $zoneId;

    #[ORM\Column(type: 'string', length: 100)]
    #[Assert\NotBlank(message: "Le modèle ne peut pas être vide")]
    #[Assert\Type(type: 'string', message: "Le modèle doit être une chaîne de caractères")]
    #[Assert\Length(
        max: 100,
        maxMessage: "Le modèle ne peut pas dépasser {{ limit }} caractères"
    )]
    private $modele;

    #[ORM\Column(type: 'string', length: 20)]
    #[Assert\NotBlank(message: "L'immatriculation ne peut pas être vide")]
    #[Assert\Type(type: 'string', message: "L'immatriculation doit être une chaîne de caractères")]
    #[Assert\Length(
        max: 20,
        maxMessage: "L'immatriculation ne peut pas dépasser {{ limit }} caractères"
    )]
    private $immatriculation;

    #[ORM\Column(type: 'float')]
    #[Assert\NotBlank(message: "Le kilométrage ne peut pas être vide")]
    #[Assert\Type(type: 'float', message: "Le kilométrage doit être un nombre")]
    #[Assert\PositiveOrZero(message: "Le kilométrage ne peut pas être négatif")]
    private $kilometrage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCapaciteMax(): ?float
    {
        return $this->capaciteMax;
    }

    public function setCapaciteMax(float $capaciteMax): self
    {
        $this->capaciteMax = $capaciteMax;
        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;
        return $this;
    }

    public function getZoneId(): ?int
    {
        return $this->zoneId;
    }

    public function setZoneId(int $zoneId): self
    {
        $this->zoneId = $zoneId;
        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;
        return $this;
    }

    public function getImmatriculation(): ?string
    {
        return $this->immatriculation;
    }

    public function setImmatriculation(string $immatriculation): self
    {
        $this->immatriculation = $immatriculation;
        return $this;
    }

    public function getKilometrage(): ?float
    {
        return $this->kilometrage;
    }

    public function setKilometrage(float $kilometrage): self
    {
        $this->kilometrage = $kilometrage;
        return $this;
    }

    public function __toString(): string
    {
        return $this->modele . ' (' . $this->immatriculation . ')';
    }
}