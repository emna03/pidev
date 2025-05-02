<?php

namespace App\Entity;

use App\Repository\DossierfiscaleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Uid\Uuid;
#[ORM\Entity(repositoryClass: DossierfiscaleRepository::class)]
class DossierFiscale
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'dossierFiscales')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $user = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "L'année fiscale est obligatoire.")]
    #[Assert\Regex(
        pattern: "/^\d{4}$/",
        message: "L'année fiscale doit être au format YYYY."
    )]
    private ?string $annee_fiscale = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Le total de l'impôt est obligatoire.")]
    #[Assert\Positive(message: "Le total de l'impôt doit être un nombre positif.")]
    private ?float $total_impot = null;

    #[ORM\Column]
    private ?float $total_impot_paye = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le statut est obligatoire.")]
    private ?string $status = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "La date de création est obligatoire.")]
    #[Assert\Date(message: "La date de création doit être valide.")]
    private ?string $date_creation = null;

    #[ORM\Column(length: 255)]
    private ?string $moyen_payement = null;

    #[ORM\OneToOne(cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?DeclarationRevenus $declaration = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $token = null;

    // Getters and Setters

    public function __construct()
    {
        $this->token = Uuid::v4()->toRfc4122();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?Utilisateur
    {
        return $this->user;
    }

    public function setIdUser(?Utilisateur $id_user): static
    {
        $this->user = $id_user;

        return $this;
    }

    public function getAnneeFiscale(): ?string
    {
        return $this->annee_fiscale;
    }

    public function setAnneeFiscale(string $annee_fiscale): static
    {
        $this->annee_fiscale = $annee_fiscale;

        return $this;
    }

    public function getTotalImpot(): ?float
    {
        return $this->total_impot;
    }

    public function setTotalImpot(float $total_impot): static
    {
        $this->total_impot = $total_impot;

        return $this;
    }

    public function getTotalImpotPaye(): ?float
    {
        return $this->total_impot_paye;
    }

    public function setTotalImpotPaye(float $total_impot_paye): static
    {
        $this->total_impot_paye = $total_impot_paye;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getDateCreation(): ?string
    {
        return $this->date_creation;
    }

    public function setDateCreation(string $date_creation): static
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getMoyenPayement(): ?string
    {
        return $this->moyen_payement;
    }

    public function setMoyenPayement(string $moyen_payement): static
    {
        $this->moyen_payement = $moyen_payement;

        return $this;
    }

    public function getIdDeclaration(): ?DeclarationRevenus
    {
        return $this->declaration;
    }

    public function setIdDeclaration(DeclarationRevenus $id_declaration): static
    {
        $this->declaration = $id_declaration;

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

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): static
    {
        $this->token = $token;

        return $this;
    }
    public function getDeclaration(): ?DeclarationRevenus
{
    return $this->declaration;
}

public function setDeclaration(?DeclarationRevenus $declaration): static
{
    $this->declaration = $declaration;
    return $this;
}
}
