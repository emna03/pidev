<?php

namespace App\Repository;

use App\Entity\Dossierfiscale;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DossierfiscaleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dossierfiscale::class);
    }

    // Add custom methods as needed
}