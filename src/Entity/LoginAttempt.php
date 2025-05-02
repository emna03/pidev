<?php

namespace App\Entity;

use App\Repository\LoginAttemptRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;

#[ORM\Entity(repositoryClass: LoginAttemptRepository::class)]
class LoginAttempt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Utilisateur::class)]
    private ?Utilisateur $utilisateur = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $ipAddress = null;

    #[ORM\Column(type: "string", length: 512)]
    private ?string $userAgent = null;

    #[ORM\Column(type: "datetime")]
    private ?DateTimeInterface $attemptedAt = null;

    #[ORM\Column(type: "string", length: 100, nullable: true)]
    private ?string $country = null;

    #[ORM\Column(type: "string", length: 100, nullable: true)]
    private ?string $region = null;

    #[ORM\Column(type: "string", length: 100, nullable: true)]
    private ?string $city = null;

    public function getId(): ?int { return $this->id; }

    public function getUtilisateur(): ?Utilisateur { return $this->utilisateur; }
    public function setUtilisateur(?Utilisateur $utilisateur): self {
        $this->utilisateur = $utilisateur;
        return $this;
    }

    public function getIpAddress(): ?string { 
        $ip =$this->ipAddress;
        $ip = $ip === '::1' ? '127.0.0.1' : $ip;  // 👉 forcer IPv4 en local


        return $ip; }
    public function setIpAddress(string $ipAddress): self {
        $this->ipAddress = $ipAddress;
        return $this;
    }

    public function getUserAgent(): ?string { return $this->userAgent; }
    public function setUserAgent(string $userAgent): self {
        $this->userAgent = $userAgent;
        return $this;
    }

    public function getAttemptedAt(): ?DateTimeInterface { return $this->attemptedAt; }
    public function setAttemptedAt(DateTimeInterface $attemptedAt): self {
        $this->attemptedAt = $attemptedAt;
        return $this;
    }

    public function getCountry(): ?string { return $this->country; }
    public function setCountry(?string $country): self {
        $this->country = $country;
        return $this;
    }

    public function getRegion(): ?string { return $this->region; }
    public function setRegion(?string $region): self {
        $this->region = $region;
        return $this;
    }

    public function getCity(): ?string { return $this->city; }
    public function setCity(?string $city): self {
        $this->city = $city;
        return $this;
    }
}
