<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\Collection;
use App\Entity\Assistantdocumentaire;

#[ORM\Entity]
class Utilisateur
{

    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue(strategy: "AUTO")] // This line ensures auto-generation
    private int $id;

    #[ORM\Column(type: "string", length: 255)]
    private string $nom;

    #[ORM\Column(type: "string", length: 255)]
    private string $prenom;

    #[ORM\Column(type: "string", length: 255)]
    private string $email;

    #[ORM\Column(type: "string")]
    private string $role;

    #[ORM\Column(type: "date")]
    private \DateTimeInterface $dateInscription;

    #[ORM\Column(type: "string", length: 255)]
    private string $motDePasse;

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($value)
    {
        $this->nom = $value;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($value)
    {
        $this->prenom = $value;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($value)
    {
        $this->email = $value;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($value)
    {
        $this->role = $value;
    }

    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    public function setDateInscription($value)
    {
        $this->dateInscription = $value;
    }

    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    public function setMotDePasse($value)
    {
        $this->motDePasse = $value;
    }

    #[ORM\OneToMany(mappedBy: "id_user", targetEntity: Dossierfiscale::class)]
    private Collection $dossierfiscales;

        public function getDossierfiscales(): Collection
        {
            return $this->dossierfiscales;
        }
    
        public function addDossierfiscale(Dossierfiscale $dossierfiscale): self
        {
            if (!$this->dossierfiscales->contains($dossierfiscale)) {
                $this->dossierfiscales[] = $dossierfiscale;
                $dossierfiscale->setId_user($this);
            }
    
            return $this;
        }
    
        public function removeDossierfiscale(Dossierfiscale $dossierfiscale): self
        {
            if ($this->dossierfiscales->removeElement($dossierfiscale)) {
                // set the owning side to null (unless already changed)
                if ($dossierfiscale->getId_user() === $this) {
                    $dossierfiscale->setId_user(null);
                }
            }
    
            return $this;
        }

    #[ORM\OneToMany(mappedBy: "id_utilisateur", targetEntity: Assistantdocumentaire::class)]
    private Collection $assistantdocumentaires;

        public function getAssistantdocumentaires(): Collection
        {
            return $this->assistantdocumentaires;
        }
    
        public function addAssistantdocumentaire(Assistantdocumentaire $assistantdocumentaire): self
        {
            if (!$this->assistantdocumentaires->contains($assistantdocumentaire)) {
                $this->assistantdocumentaires[] = $assistantdocumentaire;
                $assistantdocumentaire->setId_utilisateur($this);
            }
    
            return $this;
        }
    
        public function removeAssistantdocumentaire(Assistantdocumentaire $assistantdocumentaire): self
        {
            if ($this->assistantdocumentaires->removeElement($assistantdocumentaire)) {
                // set the owning side to null (unless already changed)
                if ($assistantdocumentaire->getId_utilisateur() === $this) {
                    $assistantdocumentaire->setId_utilisateur(null);
                }
            }
    
            return $this;
        }
}
