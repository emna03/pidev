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

    /**
     * Fetch all quartiers with their lampadaire counts and total consumption.
     *
     * @return Quartier[]
     */
    public function findAllWithLampadaireData(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        // Fetch lampadaire counts and total consumption grouped by quartier
        $sql = '
            SELECT id_quartier, COUNT(*) AS lamp_count, SUM(consommation) AS total_consumption
            FROM lampadaire
            GROUP BY id_quartier
        ';
        $stmt = $conn->executeQuery($sql);
        $lampadaireData = $stmt->fetchAllAssociative();

        // Map the data by quartier ID for easier access
        $lampadaireStats = [];
        foreach ($lampadaireData as $data) {
            $lampadaireStats[(int) $data['id_quartier']] = [
                'lamp_count' => (int) $data['lamp_count'],
                'total_consumption' => (float) $data['total_consumption'],
            ];
        }

        // Fetch all quartiers
        $quartiers = $this->findAll();

        // Add lampadaire data to each quartier
        foreach ($quartiers as $quartier) {
            $quartierId = $quartier->getId();
            if (isset($lampadaireStats[$quartierId])) {
                $quartier->setLampadaireCount($lampadaireStats[$quartierId]['lamp_count']);
                $quartier->setConsomTot($lampadaireStats[$quartierId]['total_consumption']);
            } else {
                $quartier->setLampadaireCount(0);
                $quartier->setConsomTot(0.0);
            }
        }

        return $quartiers;
    }
}