<?php
namespace App\Controller;

use App\Entity\CamionCollecte;
use App\Entity\Zone;
use App\Form\CamionCollecteType;
use App\Repository\CamionCollecteRepository;
use App\Repository\PoubelleIntelligenteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\PoubelleIntelligente;
#[Route('/camion/collecte')]
class CamionCollecteController extends AbstractController
{
    #[Route('/', name: 'app_camion_collecte_index', methods: ['GET'])]
    public function index(CamionCollecteRepository $camionCollecteRepository): Response
    {
        return $this->render('camion_collecte/index.html.twig', [
            'camion_collectes' => $camionCollecteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_camion_collecte_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $camionCollecte = new CamionCollecte();
        $form = $this->createForm(CamionCollecteType::class, $camionCollecte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Get the selected Zone entity
            $zone = $form->get('zoneId')->getData();

            // Set the zoneId on the CamionCollecte entity
            if ($zone) {
                $camionCollecte->setZoneId($zone->getId());
            }

            $entityManager->persist($camionCollecte);
            $entityManager->flush();

            return $this->redirectToRoute('app_camion_collecte_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('camion_collecte/new.html.twig', [
            'camion_collecte' => $camionCollecte,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_camion_collecte_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CamionCollecte $camionCollecte, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CamionCollecteType::class, $camionCollecte);

        // Pre-select the current Zone
        $currentZone = $entityManager->getRepository(Zone::class)->find($camionCollecte->getZoneId());
        if ($currentZone) {
            $form->get('zoneId')->setData($currentZone);
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Get the selected Zone entity
            $zone = $form->get('zoneId')->getData();

            // Update the zoneId
            if ($zone) {
                $camionCollecte->setZoneId($zone->getId());
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_camion_collecte_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('camion_collecte/edit.html.twig', [
            'camion_collecte' => $camionCollecte,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_camion_collecte_show', methods: ['GET'])]
    public function show(CamionCollecte $camionCollecte, PoubelleIntelligenteRepository $poubelleIntelligenteRepository): Response
    {
        // Fetch all poubelles with the same zoneId as the camion
        $poubelles = $poubelleIntelligenteRepository->findBy(['zoneId' => $camionCollecte->getZoneId()]);

        return $this->render('camion_collecte/show.html.twig', [
            'camion_collecte' => $camionCollecte,
            'poubelles' => $poubelles, // Pass the poubelles to the template
        ]);
    }

    #[Route('/{id}', name: 'app_camion_collecte_delete', methods: ['POST'])]
    public function delete(Request $request, CamionCollecte $camionCollecte, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $camionCollecte->getId(), $request->request->get('_token'))) {
            $entityManager->remove($camionCollecte);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_camion_collecte_index', [], Response::HTTP_SEE_OTHER);
    }
}