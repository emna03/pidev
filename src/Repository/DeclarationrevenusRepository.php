<?php

namespace App\Repository;

use App\Entity\Declarationrevenus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DeclarationrevenusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Declarationrevenus::class);
    }

    // Add custom methods as needed
}