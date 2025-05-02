<?php

namespace App\Entity;

use App\Repository\IncidentRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Utilisateur;

#[ORM\Entity(repositoryClass: IncidentRepository::class)]
class Incident
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    private $type_incident;

    // Getter and setter for type_incident
    public function getTypeIncident(): ?string
    {
        return $this->type_incident;
    }

    public function setTypeIncident(string $type_incident): self
    {
        $this->type_incident = $type_incident;
        return $this;
    }

    #[ORM\Column(type: "text")]
    private string $description;

    #[ORM\Column(type: "string", length: 255)]
    private string $localisation;

    #[ORM\Column(type: "string", length: 255, options: ["default" => "En attente"])]
    private string $statut = 'En attente';

    #[ORM\Column(type: "datetime")]
    private \DateTimeInterface $dateSignalement;

    #[ORM\ManyToOne(targetEntity: ServiceIntervention::class)]
    #[ORM\JoinColumn(name: "service_affecte", referencedColumnName: "id", nullable: true)]
    private ?ServiceIntervention $serviceAffecte = null;

    #[ORM\Column(type: "integer", nullable: true)]  // Make utilisateurId nullable
    private ?int $utilisateurId = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(type: "float", nullable: true)]
    private ?float $latitude = null;

    #[ORM\Column(type: "float", nullable: true)]
    private ?float $longitude = null;

    #[ORM\Column(type: "datetime", nullable: true)]
    private ?\DateTimeInterface $dateResolution = null;


    
    #[ORM\Column(type: 'string', length: 255)]
    private $dangerLevel;


    #[ORM\ManyToOne(targetEntity: Utilisateur::class)]
    #[ORM\JoinColumn(name: "utilisateur_id", referencedColumnName: "id", nullable: false)]
    private ?Utilisateur $user = null;

    public function getUser(): ?Utilisateur
    {
        return $this->user;
    }

    public function setUser(?Utilisateur $user): self
    {
        $this->user = $user;

        return $this;
    }
    
    public function getDangerLevel(): ?string
    {
        return $this->dangerLevel;
    }
    
    public function setDangerLevel(string $dangerLevel): self
    {
        $this->dangerLevel = $dangerLevel;
    
        return $this;
    }
    // Getters and setters for other fields

    public function getId(): ?int
    {
        return $this->id;
    }

  

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getLocalisation(): string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;
        return $this;
    }

    public function getStatut(): string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;
        return $this;
    }

    public function getDateSignalement(): \DateTimeInterface
    {
        return $this->dateSignalement;
    }

    public function setDateSignalement(\DateTimeInterface $dateSignalement): self
    {
        $this->dateSignalement = $dateSignalement;
        return $this;
    }

    public function getServiceAffecte(): ?ServiceIntervention
    {
        return $this->serviceAffecte;
    }
    
    public function setServiceAffecte(?ServiceIntervention $serviceAffecte): self
    {
        $this->serviceAffecte = $serviceAffecte;
        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;
        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(?float $latitude): self
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude): self
    {
        $this->longitude = $longitude;
        return $this;
    }

    public function getDateResolution(): ?\DateTimeInterface
    {
        return $this->dateResolution;
    }

    public function setDateResolution(?\DateTimeInterface $dateResolution): self
    {
        $this->dateResolution = $dateResolution;
        return $this;
    }
}