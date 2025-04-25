<?php

namespace App\Repository;

use App\Entity\ServiceIntervention;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ServiceIntervention>
 *
 * @method ServiceIntervention|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServiceIntervention|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServiceIntervention[]    findAll()
 * @method ServiceIntervention[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServiceInterventionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ServiceIntervention::class);
    }

    // Exemples de requêtes personnalisées :

    /**
     * @return ServiceIntervention[] Returns an array of ServiceIntervention objects
     */
    public function findByZone(string $zone): array
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.zoneIntervention = :zone')
            ->setParameter('zone', $zone)
            ->orderBy('s.nomService', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
