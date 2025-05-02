<?php
// src/Controller/PoubelleIntelligenteController.php

namespace App\Controller;

use App\Entity\PoubelleIntelligente;
use App\Entity\Zone;
use App\Form\PoubelleIntelligenteType;
use App\Repository\PoubelleIntelligenteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\SvgWriter;

#[Route('/poubelle/intelligente')]
class PoubelleIntelligenteController extends AbstractController
{
    private function sendFillLevelAlertEmail(array $poubelles, $session): bool
    {
        if (count($poubelles) === 0) {
            return false;
        }

        if ($session->get('alert_sent', false)) {
            return false;
        }

        $apiKey = '27b6dd4aad784c4b533213e5b88b56c4';
        $apiEndpoint = 'https://send.api.mailtrap.io/api/send';

        $client = HttpClient::create();

        $poubelleDetails = array_map(function (PoubelleIntelligente $poubelle) {
            return sprintf(
                "ID: %d\nType: %s\nNiveau: %d%%\nLocalisation: %s\nCoordonnées: %.6f, %.6f\nZone: %d",
                $poubelle->getId(),
                $poubelle->getTypeDechets(),
                $poubelle->getNiveauRemplissage(),
                $poubelle->getLocalisation() ?? 'Non spécifiée',
                $poubelle->getLatitude(),
                $poubelle->getLongitude(),
                $poubelle->getZoneId()
            );
        }, $poubelles);

        $emailBody = sprintf(
            "⚠️ Alert: Les poubelles suivantes sont presque pleines :\n\n%s\n\nVeuillez organiser une collecte dès que possible.",
            implode("\n\n", $poubelleDetails)
        );

        try {
            $response = $client->request('POST', $apiEndpoint, [
                'headers' => [
                    'Authorization' => "Bearer {$apiKey}",
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ],
                'json' => [
                    'from' => [
                        'email' => 'hello@demomailtrap.co',
                        'name' => 'Poubelle Intelligente System'
                    ],
                    'to' => [
                        ['email' => 'anassosuiss77@gmail.com']
                    ],
                    'subject' => '⚠️ Alerte: Poubelles presque pleines!',
                    'text' => $emailBody,
                    'category' => 'Poubelle Alert'
                ]
            ]);

            $statusCode = $response->getStatusCode();
            if ($statusCode !== 200) {
                $content = $response->getContent(false);
                $this->addFlash('warning', "L'alerte email n'a pas pu être envoyée. Code d'erreur: {$statusCode}");
                return false;
            }

            $session->set('alert_sent', true);
            return true;

        } catch (\Exception $e) {
            $this->addFlash('error', "Erreur lors de l'envoi de l'email: " . $e->getMessage());
            return false;
        }
    }

    #[Route('/', name: 'app_poubelle_intelligente_index', methods: ['GET'])]
    public function index(PoubelleIntelligenteRepository $poubelleIntelligenteRepository): Response
    {
        $poubelles = $poubelleIntelligenteRepository->findAll();
        return $this->render('poubelle_intelligente/index.html.twig', [
            'poubelle_intelligentes' => $poubelles,
        ]);
    }

    #[Route('/send-alert', name: 'app_poubelle_send_alert', methods: ['POST'])]
    public function sendAlert(Request $request, PoubelleIntelligenteRepository $repo): RedirectResponse
    {
        $session = $request->getSession();
        $poubelles = $repo->findAll();
        $poubellesToAlert = array_filter($poubelles, fn(PoubelleIntelligente $p) => $p->getNiveauRemplissage() > 80);

        if (count($poubellesToAlert) > 0) {
            if ($this->sendFillLevelAlertEmail($poubellesToAlert, $session)) {
                $this->addFlash('success', 'Alerte email envoyée avec succès pour les poubelles presque pleines.');
            }
        } else {
            $this->addFlash('info', 'Aucune poubelle ne nécessite une alerte (niveau < 80%).');
        }

        return $this->redirectToRoute('app_poubelle_intelligente_index');
    }

    #[Route('/reset-alert', name: 'app_poubelle_reset_alert', methods: ['POST'])]
    public function resetAlert(Request $request): RedirectResponse
    {
        $request->getSession()->remove('alert_sent');
        $this->addFlash('info', 'Le statut d\'alerte a été réinitialisé. Vous pouvez envoyer une nouvelle alerte.');
        return $this->redirectToRoute('app_poubelle_intelligente_index');
    }

    #[Route('/new', name: 'app_poubelle_intelligente_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $poubelleIntelligente = new PoubelleIntelligente();
        $form = $this->createForm(PoubelleIntelligenteType::class, $poubelleIntelligente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $zone = $form->get('zoneId')->getData();
            if ($zone) {
                $poubelleIntelligente->setZoneId($zone->getId());
            }

            $em->persist($poubelleIntelligente);
            $em->flush();

            return $this->redirectToRoute('app_poubelle_intelligente_index');
        }

        return $this->render('poubelle_intelligente/new.html.twig', [
            'poubelle_intelligente' => $poubelleIntelligente,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_poubelle_intelligente_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PoubelleIntelligente $poubelleIntelligente, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(PoubelleIntelligenteType::class, $poubelleIntelligente);

        if ($poubelleIntelligente->getZoneId()) {
            $zone = $em->getRepository(Zone::class)->find($poubelleIntelligente->getZoneId());
            $form->get('zoneId')->setData($zone);
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $zone = $form->get('zoneId')->getData();
            $poubelleIntelligente->setZoneId($zone ? $zone->getId() : null);

            $em->flush();

            return $this->redirectToRoute('app_poubelle_intelligente_index');
        }

        return $this->render('poubelle_intelligente/edit.html.twig', [
            'poubelle_intelligente' => $poubelleIntelligente,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_poubelle_intelligente_delete', methods: ['POST'])]
    public function delete(Request $request, PoubelleIntelligente $poubelleIntelligente, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete'.$poubelleIntelligente->getId(), $request->request->get('_token'))) {
            $em->remove($poubelleIntelligente);
            $em->flush();
        }

        return $this->redirectToRoute('app_poubelle_intelligente_index');
    }

    #[Route('/{id}/qrcode', name: 'app_poubelle_intelligente_qrcode', methods: ['GET'])]
    public function generateQrCode(PoubelleIntelligente $poubelleIntelligente): Response
    {
        $qrContent = sprintf(
            "🗑️ Poubelle Intelligente\nID: %d\nType: %s\nRemplissage: %d%%\nLocalisation: %s\nCoordonnées: %.6f, %.6f\nZone: %s",
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

    #[Route('/{id}', name: 'app_poubelle_intelligente_show', methods: ['GET'])]
public function show(PoubelleIntelligente $poubelleIntelligente): Response
{
    return $this->render('poubelle_intelligente/show.html.twig', [
        'poubelle_intelligente' => $poubelleIntelligente,
    ]);
}



#[Route('/cytoine/poubelle', name: 'app_cytoine_poubelle_list', methods: ['GET'])]
public function cytoineList(PoubelleIntelligenteRepository $poubelleIntelligenteRepository): Response
{
    $poubelles = $poubelleIntelligenteRepository->findAll();

    return $this->render('poubelle_intelligente/list.html.twig', [
        'poubelles' => $poubelles,
    ]);
}

#[Route('/cytoine/poubelle/{id}', name: 'app_cytoine_poubelle_show', methods: ['GET'])]
public function cytoineShow(PoubelleIntelligente $poubelleIntelligente): Response
{
    return $this->render('poubelle_intelligente/showc.html.twig', [
        'poubelle' => $poubelleIntelligente,
    ]);
}

}
