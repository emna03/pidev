<?php

namespace App\Repository;

use App\Entity\Documentadministratif;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DocumentadministratifRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Documentadministratif::class);
    }

    // Add custom methods as needed
    public function searchByTerm(string $term): array
    {
        return $this->createQueryBuilder('d')
            ->where('d.nomDocument LIKE :term')
            ->orWhere('d.remarque LIKE :term')
            ->setParameter('term', '%'.$term.'%')
            ->getQuery()
            ->getResult();
    }
}