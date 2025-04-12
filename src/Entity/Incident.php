<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use App\Entity\Serviceintervention;

#[ORM\Entity]
class Incident
{

    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    private int $id;

        #[ORM\ManyToOne(targetEntity: Serviceintervention::class, inversedBy: "incidents")]
    #[ORM\JoinColumn(name: 'service_affecte', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private Serviceintervention $service_affecte;

    #[ORM\Column(type: "string")]
    private string $type_incident;

    #[ORM\Column(type: "text")]
    private string $description;

    #[ORM\Column(type: "string", length: 255)]
    private string $localisation;

    #[ORM\Column(type: "string")]
    private string $statut;

    #[ORM\Column(type: "datetime")]
    private \DateTimeInterface $date_signalement;

    #[ORM\Column(type: "float")]
    private float $latitude;

    #[ORM\Column(type: "float")]
    private float $longitude;

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getService_affecte()
    {
        return $this->service_affecte;
    }

    public function setService_affecte($value)
    {
        $this->service_affecte = $value;
    }

    public function getType_incident()
    {
        return $this->type_incident;
    }

    public function setType_incident($value)
    {
        $this->type_incident = $value;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($value)
    {
        $this->description = $value;
    }

    public function getLocalisation()
    {
        return $this->localisation;
    }

    public function setLocalisation($value)
    {
        $this->localisation = $value;
    }

    public function getStatut()
    {
        return $this->statut;
    }

    public function setStatut($value)
    {
        $this->statut = $value;
    }

    public function getDate_signalement()
    {
        return $this->date_signalement;
    }

    public function setDate_signalement($value)
    {
        $this->date_signalement = $value;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLatitude($value)
    {
        $this->latitude = $value;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setLongitude($value)
    {
        $this->longitude = $value;
    }
}
