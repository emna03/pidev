<?php

namespace App\Entity;

use App\Repository\DeclarationRevenusRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DeclarationRevenusRepository::class)]
class DeclarationRevenus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Le montant du revenu est obligatoire.")]
    #[Assert\Positive(message: "Le montant du revenu doit être un nombre positif.")]
    private ?float $montant_revenu = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "La source de revenu est obligatoire.")]
    #[Assert\Regex(
        pattern: '/^[A-Za-zÀ-ÿ\s]+$/', // Only letters (including accented letters) and spaces
        message: "La source de revenu ne peut contenir que des lettres et des espaces."
    )]
    private ?string $source_revenu = null;

    #[ORM\Column(length: 255)]
    
    private ?string $date_declaration = null;

    #[ORM\Column(length: 255)]
        private ?string $preuve_revenu = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?DossierFiscale $dossier = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $user = null;

    // Getters and Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontantRevenu(): ?float
    {
        return $this->montant_revenu;
    }

    public function setMontantRevenu(float $montant_revenu): static
    {
        $this->montant_revenu = $montant_revenu;

        return $this;
    }

    public function getSourceRevenu(): ?string
    {
        return $this->source_revenu;
    }

    public function setSourceRevenu(string $source_revenu): static
    {
        $this->source_revenu = $source_revenu;

        return $this;
    }

    public function getDateDeclaration(): ?string
    {
        return $this->date_declaration;
    }

    public function setDateDeclaration(string $date_declaration): static
    {
        $this->date_declaration = $date_declaration;

        return $this;
    }

    public function getPreuveRevenu(): ?string
    {
        return $this->preuve_revenu;
    }

    public function setPreuveRevenu(string $preuve_revenu): static
    {
        $this->preuve_revenu = $preuve_revenu;

        return $this;
    }

    public function getIdDossier(): ?DossierFiscale
    {
        return $this->dossier;
    }

    public function setIdDossier(?DossierFiscale $id_dossier): static
    {
        $this->dossier = $id_dossier;

        return $this;
    }

    public function getUser(): ?Utilisateur
    {
        return $this->user;
    }

    public function setUser(?Utilisateur $user): static
    {
        $this->user = $user;

        return $this;
    }
}
