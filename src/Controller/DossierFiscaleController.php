<?php

namespace App\Controller;

use App\Entity\DeclarationRevenus;
use App\Entity\DossierFiscale;
use App\Form\DossierFiscaleType;
use App\Repository\DeclarationRevenusRepository;
use App\Repository\DossierFiscaleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Checkout\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[Route('/dossier')]
final class DossierFiscaleController extends AbstractController
{
    // User-facing routes
    #[Route(name: 'app_dossier_fiscale_index', methods: ['GET'])]
    public function index(
        DossierFiscaleRepository $dossierFiscaleRepository
    ): Response {
        // Get connected user
        $user = $this->getUser();

        if (!$user) {
            throw $this->createAccessDeniedException('Vous devez être connecté.');
        }

        // Fetch only the dossiers belonging to this user
        $dossiers = $dossierFiscaleRepository->findBy(['user' => $user]);

        return $this->render('dossier_fiscale/index.html.twig', [
            'dossier_fiscales' => $dossiers,
        ]);
    }
    private function calculertaxe(DeclarationRevenus $declaration): float
    {
        $revenu = (float) $declaration->getMontantRevenu(); // force as float
        if ($revenu === 0.0) {
            return 0.0;
        }
    
        $taux = 0.0; // force as float
    
        if ($revenu <= 5000.0) {
            $taux = 0.0;
        } elseif ($revenu <= 20000.0) {
            $taux = 0.195;
        } elseif ($revenu <= 30000.0) {
            $taux = 0.2333;
        } elseif ($revenu <= 50000.0) {
            $taux = 0.2620;
        } else {
            $taux = 0.35;
        }
    
        return (float) ($revenu * $taux);
    }
    
    #[Route('/new', name: 'app_dossier_fiscale_new', methods: ['GET', 'POST'])]
public function new(Request $request, EntityManagerInterface $entityManager, DeclarationRevenusRepository $declarationRepo): Response
{
    $dossier = new DossierFiscale();
    $declarationId = $request->query->get('declarationId');

    if ($declarationId) {
        $declaration = $declarationRepo->find($declarationId);
        if ($declaration) {
            // Set the necessary fields for the dossier
            $dossier->setIdUser($declaration->getUser());
            $this->calculertaxe($declaration);
            $dossier->setTotalImpot($this->calculertaxe($declaration));
            $dossier->setTotalImpotPaye(0);
            $dossier->setAnneeFiscale((new \DateTime($declaration->getDateDeclaration()))->format('Y'));
            $dossier->setStatus('non payé');
            $dossier->setMoyenPayement('');
            $dossier->setIdDeclaration($declaration); 
            $dossier->setDateCreation((new \DateTime())->format('Y-m-d'));
        }
    }

    $form = $this->createForm(DossierFiscaleType::class, $dossier);
    $form->handleRequest($request);


    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->persist($dossier);
        $entityManager->flush();

        if ($declaration) {
            $declaration->setIdDossier($dossier); 
            
            $entityManager->persist($declaration);
            $entityManager->flush();
        }
        return $this->redirectToRoute('admin_dossier_fiscale_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->render('/admin/dossier_fiscale/new.html.twig', [
        'form' => $form->createView(),
    ]);
}


    #[Route('/{id}', name: 'app_dossier_fiscale_show', methods: ['GET'])]
    public function show(DossierFiscale $dossierFiscale): Response
    {
        return $this->render('dossier_fiscale/show.html.twig', [
            'dossier_fiscale' => $dossierFiscale,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_dossier_fiscale_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DossierFiscale $dossierFiscale, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DossierFiscaleType::class, $dossierFiscale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_dossier_fiscale_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('dossier_fiscale/edit.html.twig', [
            'dossier_fiscale' => $dossierFiscale,
            'form' => $form,
        ]);
    }
    #[Route('/{id}', name: 'app_declaration_revenus_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        DeclarationRevenus $declarationRevenus,
        EntityManagerInterface $entityManager,
        DossierFiscaleRepository $dossierFiscaleRepo
    ): Response {
        // Check if CSRF token is valid
        if ($this->isCsrfTokenValid('delete' . $declarationRevenus->getId(), $request->request->get('_token'))) {
            
            // Find the DossierFiscale linked to this DeclarationRevenus
            $linkedDossier = $dossierFiscaleRepo->findOneBy(['declaration' => $declarationRevenus]);
            
            // If a linked DossierFiscale exists, set the 'declaration' to null (unlink the relationship)
            if ($linkedDossier) {
                $linkedDossier->setDeclaration(null); // Unlink the relation
                $entityManager->persist($linkedDossier); // Mark for persistence
            }
            
            // Now, delete the DeclarationRevenus
            $entityManager->remove($declarationRevenus);
            $entityManager->flush(); // Commit the changes

            // Redirect back to the index page or another page
            return $this->redirectToRoute('app_declaration_revenus_index', [], Response::HTTP_SEE_OTHER);
        }

        // If CSRF token is invalid, redirect or handle error
        return $this->redirectToRoute('app_declaration_revenus_index');
    }


    #[Route('/admin/dossier', name: 'admin_dossier_fiscale_index', methods: ['GET'])]
    public function adminIndex(DossierFiscaleRepository $dossierFiscaleRepository): Response
    {
        return $this->render('admin/dossier_fiscale/index.html.twig', [
            'dossiers' => $dossierFiscaleRepository->findAll(),
        ]);
    }

    #[Route('/admin/{id}', name: 'admin_dossier_fiscale_show', methods: ['GET'])]
    public function adminShow(DossierFiscale $dossierFiscale): Response
    {
        return $this->render('admin/dossier_fiscale/show.html.twig', [
            'dossier_fiscale' => $dossierFiscale,
        ]);
    }

    #[Route('/admin/{id}/edit', name: 'admin_dossier_fiscale_edit', methods: ['GET', 'POST'])]
    public function adminEdit(Request $request, DossierFiscale $dossierFiscale, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DossierFiscaleType::class, $dossierFiscale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_dossier_fiscale_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/dossier_fiscale/edit.html.twig', [
            'dossier_fiscale' => $dossierFiscale,
            'form' => $form,
        ]);
    }

    #[Route('/admin/{id}', name: 'admin_dossier_fiscale_delete', methods: ['POST'])]
    public function adminDelete(Request $request, DossierFiscale $dossierFiscale, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dossierFiscale->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($dossierFiscale);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_dossier_fiscale_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/paiement/{token}', name: 'app_dossier_fiscale_paiement')]
    public function paiement(DossierFiscale $dossierFiscale): Response
    {
        $stripePublicKey = $_ENV['STRIPE_PUBLIC_KEY'];

        return $this->render('dossier_fiscale/paiement.html.twig', [
            'dossier_fiscale' => $dossierFiscale,
            'stripe_public_key' => $stripePublicKey,
        ]);
    }
    #[Route('/create-checkout-session/{token}', name: 'create_checkout_session')]
    public function createCheckoutSession(
        string $token,
        DossierFiscaleRepository $repo,
        HttpClientInterface $client
    ): Response {
        $dossierFiscale = $repo->findOneBy(['token' => $token]);

        if (!$dossierFiscale) {
            throw $this->createNotFoundException('Dossier Fiscal not found for token: ' . $token);
        }

        $apiKey = $_ENV['EXCHANGE_RATE_API_KEY'] ;
        $response = $client->request('GET', 'https://api.exchangeratesapi.io/v1/latest?access_key=' . $apiKey);
                $data = $response->toArray();

        $tndToEur = $data['rates']['TND'] ?? 1;

        $impotRestantTND = $dossierFiscale->getTotalImpot() - $dossierFiscale->getTotalImpotPaye();
        $impotRestantUSD = $impotRestantTND / $tndToEur ;

        // Stripe setup
        \Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Paiement Dossier Fiscal - ' . $dossierFiscale->getAnneeFiscale(),
                    ],
                    'unit_amount' => (int) round($impotRestantUSD * 100), // Stripe uses cents
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $this->generateUrl('paiement_success', [
                'token' => $dossierFiscale->getToken()
            ], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('app_dossier_fiscale_paiement', [
                'token' => $dossierFiscale->getToken()
            ], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);

        return $this->json(['id' => $session->id]);
    }
    #[Route('/paiement-success/{token}', name: 'paiement_success')]
    public function paiementSuccess(string $token, DossierFiscaleRepository $dossierFiscaleRepository,EntityManagerInterface $en): Response
    {
        // Find the DossierFiscale by token
        $dossierFiscale = $dossierFiscaleRepository->findOneBy(['token' => $token]);
    
        if (!$dossierFiscale) {
            throw $this->createNotFoundException('Dossier Fiscal not found for token: ' . $token);
        }
    
        $dossierFiscale->setTotalImpotPaye($dossierFiscale->getTotalImpot());
        $dossierFiscale->setStatus('Payé');
        $dossierFiscale->setMoyenPayement('Stripe');
        
        $en->flush();
    
        return $this->render('dossier_fiscale/paiement_success.html.twig', [
            'dossier_fiscale' => $dossierFiscale,
        ]);
    }
    
    


}
