<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use App\Entity\Utilisateur;
use Doctrine\Common\Collections\Collection;
use App\Entity\Declarationrevenus;

#[ORM\Entity]
class DossierFiscale
{

    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    private int $id;

        #[ORM\ManyToOne(targetEntity: Utilisateur::class, inversedBy: "dossierfiscales")]
    #[ORM\JoinColumn(name: 'id_user', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private Utilisateur $id_user;

    #[ORM\Column(type: "integer")]
    private int $annee_fiscale;

    #[ORM\Column(type: "float")]
    private float $total_impot;

    #[ORM\Column(type: "float")]
    private float $total_impot_paye;

    #[ORM\Column(type: "string", length: 255)]
    private string $status;

    #[ORM\Column(type: "string", length: 255)]
    private string $date_creation;

    #[ORM\Column(type: "string", length: 255)]
    private string $moyen_paiement;

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getId_user()
    {
        return $this->id_user;
    }

    public function setId_user($value)
    {
        $this->id_user = $value;
    }

    public function getAnnee_fiscale()
    {
        return $this->annee_fiscale;
    }

    public function setAnnee_fiscale($value)
    {
        $this->annee_fiscale = $value;
    }

    public function getTotal_impot()
    {
        return $this->total_impot;
    }

    public function setTotal_impot($value)
    {
        $this->total_impot = $value;
    }

    public function getTotal_impot_paye()
    {
        return $this->total_impot_paye;
    }

    public function setTotal_impot_paye($value)
    {
        $this->total_impot_paye = $value;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($value)
    {
        $this->status = $value;
    }

    public function getDate_creation()
    {
        return $this->date_creation;
    }

    public function setDate_creation($value)
    {
        $this->date_creation = $value;
    }

    public function getMoyen_paiement()
    {
        return $this->moyen_paiement;
    }

    public function setMoyen_paiement($value)
    {
        $this->moyen_paiement = $value;
    }

    #[ORM\OneToMany(mappedBy: "id_dossier", targetEntity: Declarationrevenus::class)]
    private Collection $declarationrevenuss;
}
