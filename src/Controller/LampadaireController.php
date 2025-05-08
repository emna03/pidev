<?php

namespace App\Controller;

use App\Entity\Lampadaire;
use App\Form\LampadaireType;
use App\Repository\QuartierRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/lampadaire')]
class LampadaireController extends AbstractController
{
    #[Route('/statistiques', name: 'app_statistiques', methods: ['GET'])]
    public function statistiques(EntityManagerInterface $em): Response
    {
        $conn = $em->getConnection();

        $total = $conn->fetchOne('SELECT COUNT(*) FROM lampadaire');
        $actifs = $conn->fetchOne('SELECT COUNT(*) FROM lampadaire WHERE etat = 1');
        $inactifs = $total - $actifs;
        $moyenne = $conn->fetchOne('SELECT AVG(consommation) FROM lampadaire');

        $consoParQuartier = $conn->fetchAllAssociative('
            SELECT q.nom AS quartier, SUM(l.consommation) AS total
            FROM quartier q
            JOIN lampadaire l ON q.id = l.id_quartier
            GROUP BY q.nom
        ');

        return $this->render('lampadaire/statistiques.html.twig', [
            'total' => $total,
            'actifs' => $actifs,
            'inactifs' => $inactifs,
            'moyenne' => $moyenne,
            'consoParQuartier' => $consoParQuartier,
        ]);
    }

    #[Route('/', name: 'app_lampadaire_index', methods: ['GET'])]
    public function index(Request $request, EntityManagerInterface $entityManager, PaginatorInterface $paginator): Response
    {
        $dateFilter = $request->query->get('date');
        $mode = $request->query->get('mode');

        $qb = $entityManager->getRepository(Lampadaire::class)->createQueryBuilder('l')
                             ->leftJoin('l.quartier', 'q')
                             ->addSelect('q');

        if ($dateFilter && $mode) {
            try {
                $date = new \DateTime($dateFilter);

                if ($mode === 'before') {
                    $qb->andWhere('l.dateInstallation < :date');
                } elseif ($mode === 'after') {
                    $qb->andWhere('l.dateInstallation > :date');
                } elseif ($mode === 'on') {
                    $qb->andWhere('l.dateInstallation = :date');
                }

                $qb->setParameter('date', $date->format('Y-m-d'));
            } catch (\Exception $e) {
                // ignore invalid date
            }
        }

        // Create pagination
        $pagination = $paginator->paginate(
            $qb->getQuery(),
            $request->query->getInt('page', 1),
            10 // Items per page
        );

        return $this->render('lampadaire/index.html.twig', [
            'lampadaires' => $pagination,
            'selectedDate' => $dateFilter,
            'selectedMode' => $mode
        ]);
    }

    #[Route('/new', name: 'app_lampadaire_new', methods: ['GET', 'POST'])]
public function new(Request $request, EntityManagerInterface $entityManager, QuartierRepository $quartierRepository): Response
{
    $lampadaire = new Lampadaire();

    if ($request->isMethod('POST')) {
        $lampadaire->setLocalisation($request->request->get('localisation'));
        $lampadaire->setEtat((bool)$request->request->get('etat'));
        $lampadaire->setConsommation((float)$request->request->get('consommation'));

        $quartierId = $request->request->get('quartier');
        $quartier = $quartierRepository->find($quartierId);
        $lampadaire->setQuartier($quartier);

        $date = \DateTime::createFromFormat('Y-m-d', $request->request->get('dateInstallation'));
        if ($date) {
            $lampadaire->setDateInstallation($date);
        }

        $entityManager->persist($lampadaire);
        $entityManager->flush();

        return $this->redirectToRoute('app_lampadaire_index');
    }

    $quartiers = $quartierRepository->findAllWithLampadaireData();

    return $this->render('lampadaire/new.html.twig', [
        'lampadaire' => $lampadaire,
        'quartiers' => $quartiers,
    ]);
}


    #[Route('/citoyen/lampadaires', name: 'citizen_lampadaire_index', methods: ['GET'])]
    public function citizenIndex(Request $request, EntityManagerInterface $entityManager, PaginatorInterface $paginator): Response
    {
        $dateFilter = $request->query->get('date');
        $mode = $request->query->get('mode');

        $qb = $entityManager->getRepository(Lampadaire::class)->createQueryBuilder('l')
                             ->leftJoin('l.quartier', 'q')
                             ->addSelect('q');

        if ($dateFilter && $mode) {
            try {
                $date = new \DateTime($dateFilter);

                if ($mode === 'before') {
                    $qb->andWhere('l.dateInstallation < :date');
                } elseif ($mode === 'after') {
                    $qb->andWhere('l.dateInstallation > :date');
                } elseif ($mode === 'on') {
                    $qb->andWhere('l.dateInstallation = :date');
                }

                $qb->setParameter('date', $date->format('Y-m-d'));
            } catch (\Exception $e) {
                // ignore
            }
        }

        // Create pagination
        $pagination = $paginator->paginate(
            $qb->getQuery(),
            $request->query->getInt('page', 1),
            9 // Items per page (3x3 grid)
        );

        return $this->render('lampadaire/indexc.html.twig', [
            'lampadaires' => $pagination,
            'selectedDate' => $dateFilter,
            'selectedMode' => $mode,
        ]);
    }

    #[Route('/citoyen/lampadaires/{id}', name: 'citizen_lampadaire_show', methods: ['GET'])]
    public function citizenShow(Lampadaire $lampadaire): Response
    {
        return $this->render('lampadaire/showc.html.twig', [
            'lampadaire' => $lampadaire,
        ]);
    }

    #[Route('/{id}', name: 'app_lampadaire_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(Lampadaire $lampadaire): Response
    {
        return $this->render('lampadaire/show.html.twig', [
            'lampadaire' => $lampadaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_lampadaire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Lampadaire $lampadaire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LampadaireType::class, $lampadaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_lampadaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lampadaire/edit.html.twig', [
            'lampadaire' => $lampadaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lampadaire_delete', methods: ['POST'])]
    public function delete(Request $request, Lampadaire $lampadaire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lampadaire->getId(), $request->request->get('_token'))) {
            $entityManager->remove($lampadaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_lampadaire_index', [], Response::HTTP_SEE_OTHER);
    }






    #[Route('/api/lampadaires/{idQuartier}', name: 'api_lampadaire_by_quartier', methods: ['GET'])]
public function getLampadairesByQuartier(int $idQuartier, EntityManagerInterface $entityManager): Response
{
    $lampadaires = $entityManager->getRepository(\App\Entity\Lampadaire::class)
        ->findBy(['quartier' => $idQuartier]);

    $data = [];

    foreach ($lampadaires as $lamp) {
        $data[] = [
            'localisation' => $lamp->getLocalisation(),
            'consommation' => $lamp->getConsommation(),
            'etat' => $lamp->isEtat(),
        ];
    }

    return $this->json($data);
}

}
