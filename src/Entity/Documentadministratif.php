<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;
use App\Entity\Assistantdocumentaire;
#[ORM\Entity]
class Documentadministratif
{

    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue(strategy: "AUTO")] // This line ensures auto-generation
    private int $id;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank(message: "Le nom du document est obligatoire")]
    #[Assert\Length(
        max: 255,
        maxMessage: "Le nom du document ne peut pas dépasser {{ limit }} caractères"
    )]
    private string $nomDocument;

    #[ORM\Column(type: "string", length: 255)]
    private string $cheminFichier;

    #[ORM\Column(type: "date", nullable: false, options: ["default" => "CURRENT_DATE"])]
    private ?\DateTimeInterface $dateEmission = null; // Allow nullable
    #[ORM\PrePersist]
    public function setDefaultDateEmission(): void
    {
        if ($this->dateEmission === null) {
            $this->dateEmission = new \DateTime(); // Set to current date if not already set
        }
    }

    public function getDateEmission(): ?\DateTimeInterface
    {
        return $this->dateEmission;
    }
  
    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank(message: "Le statut est obligatoire")]
    #[Assert\Choice(
        choices: ["Brouillon", "Validé", "Archivé", "Rejeté"],
        message: "Le statut doit être parmi: Brouillon, Validé, Archivé, Rejeté"
    )]
    private string $status;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\Length(
        max: 255,
        maxMessage: "La remarque ne peut pas dépasser {{ limit }} caractères"
    )]
    #[Assert\NotBlank(message: "remplire le champs remarque ")]

    private string $remarque;

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getNomDocument()
    {
        return $this->nomDocument;
    }

    public function setNomDocument($value)
    {
        $this->nomDocument = $value;
    }

    public function getCheminFichier()
    {
        return $this->cheminFichier;
    }

    public function setCheminFichier($value)
    {
        $this->cheminFichier = $value;
    }

   
    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($value)
    {
        $this->status = $value;
    }

    public function getRemarque()
    {
        return $this->remarque;
    }

    public function setRemarque($value)
    {
        $this->remarque = $value;
    }

    #[ORM\OneToMany(mappedBy: "id_document", targetEntity: Assistantdocumentaire::class)]
    private Collection $assistantdocumentaires;

        public function getAssistantdocumentaires(): Collection
        {
            return $this->assistantdocumentaires;
        }
    
        public function addAssistantdocumentaire(Assistantdocumentaire $assistantdocumentaire): self
        {
            if (!$this->assistantdocumentaires->contains($assistantdocumentaire)) {
                $this->assistantdocumentaires[] = $assistantdocumentaire;
                $assistantdocumentaire->setId_document($this);
            }
    
            return $this;
        }
    
        public function removeAssistantdocumentaire(Assistantdocumentaire $assistantdocumentaire): self
        {
            if ($this->assistantdocumentaires->removeElement($assistantdocumentaire)) {
                // set the owning side to null (unless already changed)
                if ($assistantdocumentaire->getId_document() === $this) {
                    $assistantdocumentaire->setId_document(null);
                }
            }
    
            return $this;
        }
        // Add this in the constructor:
public function __construct()
{
    $this->dateEmission = new \DateTime(); // Set the current date by default
}

}
