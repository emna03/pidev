<?php

namespace App\Controller;

use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminStatistiquesController extends AbstractController
{
    #[Route('/admin/statistiques', name: 'admin_statistiques')]
    public function index(): Response
    {
        return $this->render('admin/statistiques.html.twig');
    }

    #[Route('/api/statistics/users', name: 'api_statistics_users')]
    public function userStats(UtilisateurRepository $repo): JsonResponse
    {
        // 1. Rôles (Admin / Citoyen)
        $roles = [
            'Admin' => $repo->count(['role' => 'Admin']),
            'Citoyen' => $repo->count(['role' => 'Citoyen']),
        ];

        // 2. Activés / Désactivés
        $active = $repo->count(['activer' => 1]);
        $inactive = $repo->count(['activer' => 0]);

        // 3. Inscriptions par mois (via requête SQL brute)
        $connection = $repo->getEntityManager()->getConnection();
        $stmt = $connection->executeQuery("
            SELECT DATE_FORMAT(date_inscription, '%Y-%m') AS month, COUNT(*) AS count
            FROM utilisateur
            GROUP BY month
            ORDER BY month
        ");
        $monthly = $stmt->fetchAllAssociative();

        return new JsonResponse([
            'roles' => $roles,
            'active' => $active,
            'inactive' => $inactive,
            'monthly' => $monthly,
        ]);
    }
}
