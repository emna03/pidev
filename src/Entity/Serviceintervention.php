<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\Collection;
use App\Entity\Incident;

#[ORM\Entity]
class Serviceintervention
{

    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 255)]
    private string $nom_service;

    #[ORM\Column(type: "string")]
    private string $type_intervention;

    #[ORM\Column(type: "string", length: 255)]
    private string $zone_intervention;

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getNom_service()
    {
        return $this->nom_service;
    }

    public function setNom_service($value)
    {
        $this->nom_service = $value;
    }

    public function getType_intervention()
    {
        return $this->type_intervention;
    }

    public function setType_intervention($value)
    {
        $this->type_intervention = $value;
    }

    public function getZone_intervention()
    {
        return $this->zone_intervention;
    }

    public function setZone_intervention($value)
    {
        $this->zone_intervention = $value;
    }

    #[ORM\OneToMany(mappedBy: "service_affecte", targetEntity: Incident::class)]
    private Collection $incidents;

        public function getIncidents(): Collection
        {
            return $this->incidents;
        }
    
        public function addIncident(Incident $incident): self
        {
            if (!$this->incidents->contains($incident)) {
                $this->incidents[] = $incident;
                $incident->setService_affecte($this);
            }
    
            return $this;
        }
    
        public function removeIncident(Incident $incident): self
        {
            if ($this->incidents->removeElement($incident)) {
                // set the owning side to null (unless already changed)
                if ($incident->getService_affecte() === $this) {
                    $incident->setService_affecte(null);
                }
            }
    
            return $this;
        }
}
