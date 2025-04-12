<?php

namespace App\Repository;

use App\Entity\Assistantdocumentaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AssistantdocumentaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Assistantdocumentaire::class);
    }

    // Add custom methods as needed
}