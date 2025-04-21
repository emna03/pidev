<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use App\Entity\Dossierfiscale;

#[ORM\Entity]
class DeclarationRevenus
{

    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    private int $id;

        #[ORM\ManyToOne(targetEntity: Dossierfiscale::class, inversedBy: "declarationrevenuss")]
    #[ORM\JoinColumn(name: 'id_dossier', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private Dossierfiscale $id_dossier;

    #[ORM\Column(type: "float")]
    private float $montant_revenu;

    #[ORM\Column(type: "string", length: 255)]
    private string $source_revenu;

    #[ORM\Column(type: "string", length: 255)]
    private string $date_declaration;

    #[ORM\Column(type: "string", length: 255)]
    private string $preuve_revenu;

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getId_dossier()
    {
        return $this->id_dossier;
    }

    public function setId_dossier($value)
    {
        $this->id_dossier = $value;
    }

    public function getMontant_revenu()
    {
        return $this->montant_revenu;
    }

    public function setMontant_revenu($value)
    {
        $this->montant_revenu = $value;
    }

    public function getSource_revenu()
    {
        return $this->source_revenu;
    }

    public function setSource_revenu($value)
    {
        $this->source_revenu = $value;
    }

    public function getDate_declaration()
    {
        return $this->date_declaration;
    }

    public function setDate_declaration($value)
    {
        $this->date_declaration = $value;
    }

    public function getPreuve_revenu()
    {
        return $this->preuve_revenu;
    }

    public function setPreuve_revenu($value)
    {
        $this->preuve_revenu = $value;
    }
}
