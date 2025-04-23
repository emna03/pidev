<?php

namespace App\Repository;

use App\Entity\Quartier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class QuartierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Quartier::class);
    }

    public function findAllWithLampadaireData(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT id_quartier, COUNT(*) AS lamp_count, SUM(consommation) AS total_consumption
            FROM lampadaire
            GROUP BY id_quartier
        ';
        $stmt = $conn->executeQuery($sql);
        $lampadaireData = $stmt->fetchAllAssociative();

        $lampadaireStats = [];
        foreach ($lampadaireData as $data) {
            $lampadaireStats[(int) $data['id_quartier']] = [
                'lamp_count' => (int) $data['lamp_count'],
                'total_consumption' => (float) $data['total_consumption'],
            ];
        }

        $quartiers = $this->findAll();

        foreach ($quartiers as $quartier) {
            $id = $quartier->getId();
            $quartier->setLampadaireCount($lampadaireStats[$id]['lamp_count'] ?? 0);
            $quartier->setConsomTot($lampadaireStats[$id]['total_consumption'] ?? 0.0);
        }

        return $quartiers;
    }

    public function findWithFilters(string $search, float $min, float $max): array
    {
        $quartiers = $this->findAllWithLampadaireData();

        return array_filter($quartiers, function ($quartier) use ($search, $min, $max) {
            return str_contains(strtolower($quartier->getNom()), strtolower($search))
                && $quartier->getConsomTot() >= $min
                && $quartier->getConsomTot() <= $max;
        });
    }
}
