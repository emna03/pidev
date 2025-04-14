<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use App\Repository\UtilisateurRepository;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[ORM\Table(name: 'utilisateur')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $nom = null;

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $prenom = null;

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $email = null;

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $role = null;

    #[ORM\Column(type: 'date', nullable: false)]
    private ?\DateTimeInterface $dateInscription = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $motDePasse = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $visage_hash = null;

    #[ORM\Column(type: 'integer', nullable: false)]
    private ?int $activer = null;
    
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $photo_profil = null;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private ?string $numero_telephone = null;

    // ==========================
    // Getters & Setters
    // ==========================

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;
        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeInterface $dateInscription): self
    {
        $this->dateInscription = $dateInscription;
        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->motDePasse;
    }

    public function setMotDePasse(?string $motDePasse): self
    {
        $this->motDePasse = $motDePasse;
        return $this;
    }

    public function getVisage_hash(): ?string
    {
        return $this->visage_hash;
    }

    public function setVisage_hash(?string $visage_hash): self
    {
        $this->visage_hash = $visage_hash;
        return $this;
    }

    public function getActiver(): ?int
    {
        return $this->activer;
    }

    public function setActiver(int $activer): self
    {
        $this->activer = $activer;
        return $this;
    }
    public function activate(): self
    {
        $this->activer = 1;
        return $this;
    }
    
    public function deactivate(): self
    {
        $this->activer = 0;
        return $this;
    }
    
    public function isActivated(): bool
    {
        return $this->activer === 1;
    }
    // ==========================
    // Interfaces Symfony
    // ==========================

    public function getPassword(): ?string
    {
        return $this->motDePasse;
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getRoles(): array
{
    $roles = ['ROLE_USER']; // toujours requis

    if ($this->role === 'Admin') {
        $roles[] = 'ROLE_ADMIN';
    } elseif ($this->role === 'Citoyen') {
        $roles[] = 'ROLE_CITOYEN';
    }

    return $roles;
}

    public function eraseCredentials(): void
    {
        // Laisser vide sauf si tu veux effacer des infos sensibles (ex: mot de passe en clair)
    }

    public function getPhotoProfil(): ?string
{
    return $this->photo_profil;
}

    public function setPhotoProfil(?string $photo_profil): self
    {
    $this->photo_profil = $photo_profil;
    return $this;
    }

    public function getNumeroTelephone(): ?string
    {
        return $this->numero_telephone;
    }

    public function setNumeroTelephone(?string $numero_telephone): self
    {
        $this->numero_telephone = $numero_telephone;
        return $this;
    }
}
