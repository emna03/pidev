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


    // Ajouter d'autres requêtes personnalisées si besoin
}
