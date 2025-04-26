<?php

namespace App\Repository;

use App\Entity\Utilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Utilisateur>
 *
 * @method Utilisateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Utilisateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Utilisateur[]    findAll()
 * @method Utilisateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UtilisateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Utilisateur::class);
    }

    // Exemple de méthode personnalisée
    public function findActiveUsers(): array
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.activer = :active')
            ->setParameter('active', 1)
            ->orderBy('u.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }
    public function searchByNomOrEmail(string $term): array
{
    
    return $this->createQueryBuilder('u')
        ->where('u.nom LIKE :term OR u.prenom LIKE :term OR u.email LIKE :term')
        ->setParameter('term', '%' . $term . '%')
        ->orderBy('u.nom', 'ASC')
        ->getQuery()
        ->getResult();
}


public function getStatistics(): array
    {
        $qb = $this->createQueryBuilder('u');

        // Nombre total
        $total = $qb->select('COUNT(u.id)')->getQuery()->getSingleScalarResult();

        // Nombre actif / inactif
        $actif = $this->createQueryBuilder('u')
            ->select('COUNT(u.id)')
            ->where('u.activer = 1')
            ->getQuery()->getSingleScalarResult();

        $inactif = $this->createQueryBuilder('u')
            ->select('COUNT(u.id)')
            ->where('u.activer = 0')
            ->getQuery()->getSingleScalarResult();

        // Répartition des rôles
        $roles = $this->createQueryBuilder('u')
            ->select('u.role AS role, COUNT(u.id) AS count')
            ->groupBy('u.role')
            ->getQuery()->getResult();

        // Inscriptions par mois (12 derniers mois)
        $inscriptionsParMois = $this->createQueryBuilder('u')
            ->select("SUBSTRING(u.dateInscription, 1, 7) AS mois, COUNT(u.id) AS nombre")
            ->groupBy('mois')
            ->orderBy('mois', 'DESC')
            ->setMaxResults(12)
            ->getQuery()
            ->getResult();

        return [
            'total' => $total,
            'actif' => $actif,
            'inactif' => $inactif,
            'roles' => $roles,
            'par_mois' => array_reverse($inscriptionsParMois), // pour avoir chronologique
        ];
    }


    // Ajouter d'autres requêtes personnalisées si besoin
}
