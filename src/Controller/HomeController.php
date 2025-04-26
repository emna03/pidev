<?php

namespace App\Controller;

use App\Entity\Documentadministratif;
use App\Form\DocumentadministratifType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/back', name: 'dashboard')]
    public function index2(EntityManagerInterface $entityManager): Response
    {
         // Calculate counts for "Validé" and "Rejeté"
    $countValide = $entityManager->getRepository(Documentadministratif::class)
    ->createQueryBuilder('d')
    ->select('COUNT(d.id)')
    ->where('d.status = :status')
    ->setParameter('status', 'Validé')
    ->getQuery()
    ->getSingleScalarResult();

$countRejete = $entityManager->getRepository(Documentadministratif::class)
    ->createQueryBuilder('d')
    ->select('COUNT(d.id)')
    ->where('d.status = :status')
    ->setParameter('status', 'Rejeté')
    ->getQuery()
    ->getSingleScalarResult();

return $this->render('home/index2.html.twig', [
    'count_valide' => $countValide, // Pass counts to the template
    'count_rejete' => $countRejete,
]);
        return $this->render('home/index2.html.twig');
    }
    
    #[Route('/', name: 'home')]
    public function index3(): Response
    {
        return $this->render('home/index.html.twig');
    }
    
}
