<?php

namespace App\Entity;

use App\Repository\TentativeFraudeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TentativeFraudeRepository::class)]
class TentativeFraude
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?DeclarationRevenus $declaration = null;

    #[ORM\Column(length: 255)]
    private ?string $type_fraude = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTypeFraude(): ?string
    {
        return $this->type_fraude;
    }

    public function setTypeFraude(string $type_fraude): static
    {
        $this->type_fraude = $type_fraude;

        return $this;
    }
}
