<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'zone')]
class Zone
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $location;

    #[ORM\Column(type: 'float')]
    private $latitude;

    #[ORM\Column(type: 'float')]
    private $longitude;

    public function __construct(?int $id = null, ?string $location = null, ?float $latitude = null, ?float $longitude = null)
    {
        $this->id = $id;
        $this->location = $location;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): void
    {
        $this->latitude = $latitude;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): void
    {
        $this->longitude = $longitude;
    }

    public function getLocalisation(): ?string
    {
        return $this->location;
    }

    public function setLocalisation(string $localisation): void
    {
        $this->location = $localisation;
    }
}