<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Documentadministratif;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Utilisateur;

#[ORM\Entity]
class Assistantdocumentaire
{
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Utilisateur::class)]
    #[ORM\JoinColumn(name: "id_utilisateur", referencedColumnName: "id")]
    private Utilisateur $utilisateur;

    #[ORM\ManyToOne(targetEntity: Documentadministratif::class)]
    #[ORM\JoinColumn(name: "id_document", referencedColumnName: "id")]
    private ?Documentadministratif $document = null;

    #[ORM\Column(name: "type_assistance", type: "string", length: 255)]
    #[Assert\NotBlank(message: "Le type d'assistance est obligatoire")]
    #[Assert\Choice(
        choices: ["Correction", "Vérification", "Complétion", "Traduction", "Autre"],
        message: "Choisissez un type d'assistance valide"
    )]
    private string $typeAssistance;
    public function getTypeAssistance(): string
    {
        return $this->typeAssistance;
    }

    public function setTypeAssistance(string $typeAssistance): self
    {
        $this->typeAssistance = $typeAssistance;
        return $this;
    }

    #[ORM\Column(name: "date_demande", type: "datetime")] // Changed type to "datetime"
    #[Assert\NotNull(message: "La date de demande est obligatoire")]
    #[Assert\LessThanOrEqual(
        "today",
        message: "La date de demande ne peut pas être dans le futur"
    )]
    private \DateTimeInterface $dateDemande; // Changed from string to DateTimeInterface
    
    // Update getter and setter
    public function getDateDemande(): \DateTimeInterface
    {
        return $this->dateDemande;
    }
    
    public function setDateDemande(\DateTimeInterface $dateDemande): self
    {
        $this->dateDemande = $dateDemande;
        return $this;
    }

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank(message: "Le statut est obligatoire")]
    #[Assert\Choice(
        choices: ["Pending", "Approved", "Rejected"],
        message: "Le statut doit être Pending, Approved ou Rejected"
    )]
    private string $status;

    #[ORM\Column(type: "text")]
    #[Assert\NotBlank(message: "La remarque est obligatoire")]
    private string $remarque;

    #[ORM\Column(name: "rappel_automatique", type: "boolean")]
    private bool $rappelAutomatique; // Renamed to camelCase

    // Getters and Setters
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getUtilisateur(): Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;
        return $this;
    }

    public function getDocument(): ?Documentadministratif
    {
        return $this->document;
    }

    public function setDocument(?Documentadministratif $document): self
    {
        $this->document = $document;
        return $this;
    }

   

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getRemarque(): string
    {
        return $this->remarque;
    }

    public function setRemarque(string $remarque): self
    {
        $this->remarque = $remarque;
        return $this;
    }

    public function isRappelAutomatique(): bool
    {
        return $this->rappelAutomatique;
    }

    public function setRappelAutomatique(bool $rappelAutomatique): self
    {
        $this->rappelAutomatique = $rappelAutomatique;
        return $this;
    }
}