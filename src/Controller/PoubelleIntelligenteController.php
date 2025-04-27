<?php
// src/Controller/PoubelleIntelligenteController.php

namespace App\Controller;

use App\Entity\PoubelleIntelligente;
use App\Form\PoubelleIntelligenteType;
use App\Repository\PoubelleIntelligenteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\SvgWriter;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;


#[Route('/poubelle/intelligente')]
class PoubelleIntelligenteController extends AbstractController
{
    #[Route('/', name: 'app_poubelle_intelligente_index', methods: ['GET'])]
    public function index(PoubelleIntelligenteRepository $poubelleIntelligenteRepository): Response
    {
        return $this->render('poubelle_intelligente/index.html.twig', [
            'poubelle_intelligentes' => $poubelleIntelligenteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_poubelle_intelligente_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $poubelleIntelligente = new PoubelleIntelligente();
        $form = $this->createForm(PoubelleIntelligenteType::class, $poubelleIntelligente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Get the selected Zone entity from the form
            $zone = $form->get('zoneId')->getData();
            if ($zone) {
                // Set the zone's ID into the zoneId field
                $poubelleIntelligente->setZoneId($zone->getId());
            }

            $entityManager->persist($poubelleIntelligente);
            $entityManager->flush();

            return $this->redirectToRoute('app_poubelle_intelligente_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('poubelle_intelligente/new.html.twig', [
            'poubelle_intelligente' => $poubelleIntelligente,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_poubelle_intelligente_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PoubelleIntelligente $poubelleIntelligente, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PoubelleIntelligenteType::class, $poubelleIntelligente);
        
        // Pre-select the current zone in the form
        if ($poubelleIntelligente->getZoneId()) {
            $zone = $entityManager->getRepository(Zone::class)->find($poubelleIntelligente->getZoneId());
            $form->get('zoneId')->setData($zone);
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Update the zoneId from the selected Zone entity
            $zone = $form->get('zoneId')->getData();
            $poubelleIntelligente->setZoneId($zone ? $zone->getId() : null);

            $entityManager->flush();

            return $this->redirectToRoute('app_poubelle_intelligente_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('poubelle_intelligente/edit.html.twig', [
            'poubelle_intelligente' => $poubelleIntelligente,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_poubelle_intelligente_delete', methods: ['POST'])]
    public function delete(Request $request, PoubelleIntelligente $poubelleIntelligente, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$poubelleIntelligente->getId(), $request->request->get('_token'))) {
            $entityManager->remove($poubelleIntelligente);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_poubelle_intelligente_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/qr', name: 'app_poubelle_intelligente_qr', methods: ['GET'])]
    public function generateQrCode(PoubelleIntelligente $poubelleIntelligente): Response
    {
        $qrContent = sprintf(
            "🗑️ Poubelle Intelligente\nID : %d\nType de Déchets : %s\nRemplissage : %d%%\n📍 Localisation : %s\nLatitude : %.6f\nLongitude : %.6f\nZone : %s",
            $poubelleIntelligente->getId(),
            $poubelleIntelligente->getTypeDechets(),
            $poubelleIntelligente->getNiveauRemplissage(),
            $poubelleIntelligente->getLocalisation(),
            $poubelleIntelligente->getLatitude(),
            $poubelleIntelligente->getLongitude(),
            $poubelleIntelligente->getZoneId()
        );
        
        $result = Builder::create()
            ->writer(new SvgWriter())
            ->data($qrContent)
            ->size(300)
            ->margin(10)
            ->build();

        return new Response($result->getString(), 200, [
            'Content-Type' => 'image/svg+xml',
        ]);
    }
    

}   