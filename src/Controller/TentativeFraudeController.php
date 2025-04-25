<?php

namespace App\Controller;

use App\Entity\DeclarationRevenus;
use App\Entity\TentativeFraude;
use App\Entity\Utilisateur;
use App\Form\TentativeFraudeType;
use App\Repository\TentativeFraudeRepository;
use App\Service\SmsService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('admin/fraude')]
final class TentativeFraudeController extends AbstractController{
    private $smsService;

    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
    }

    
    #[Route(name: 'app_tentative_fraude_index', methods: ['GET'])]
    public function index(TentativeFraudeRepository $tentativeFraudeRepository): Response
    {
        return $this->render('tentative_fraude/index.html.twig', [
            'tentative_fraudes' => $tentativeFraudeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tentative_fraude_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tentativeFraude = new TentativeFraude();
        $form = $this->createForm(TentativeFraudeType::class, $tentativeFraude);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tentativeFraude);
            $entityManager->flush();

            return $this->redirectToRoute('app_tentative_fraude_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tentative_fraude/new.html.twig', [
            'tentative_fraude' => $tentativeFraude,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tentative_fraude_show', methods: ['GET'])]
    public function show(TentativeFraude $tentativeFraude): Response
    {
        return $this->render('tentative_fraude/show.html.twig', [
            'tentative_fraude' => $tentativeFraude,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tentative_fraude_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TentativeFraude $tentativeFraude, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TentativeFraudeType::class, $tentativeFraude);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_tentative_fraude_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tentative_fraude/edit.html.twig', [
            'tentative_fraude' => $tentativeFraude,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tentative_fraude_delete', methods: ['POST'])]
    public function delete(Request $request, TentativeFraude $tentativeFraude, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tentativeFraude->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($tentativeFraude);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_tentative_fraude_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/fraude/{declarationId}', name: 'app_tentative_fraude_add', methods: ['POST'])]
    public function addTentativeFraude(Request $request, EntityManagerInterface $em, int $declarationId): Response
    {
        $type = $request->request->get('type_fraude');
        $declaration = $em->getRepository(DeclarationRevenus::class)->find($declarationId);

        if (!$declaration) {
            throw $this->createNotFoundException('Déclaration introuvable');
        }

        // Create new fraud attempt and save it
        $fraude = new TentativeFraude();
        $fraude->setDeclaration($declaration);
        $fraude->setTypeFraude($type);

        $em->persist($fraude);
        $em->flush();

        // Add a flash success message
        $this->addFlash('success', 'Tentative de fraude signalée avec succès.');
        $user = $declaration->getUser();
        $nom = $user->getNom();
        $prenom = $user->getPrenom();
        $montant = $declaration->getMontantRevenu();
        $source = $declaration->getSourceRevenu();
        $typeFraude = $fraude->getTypeFraude();



        $message = "Tentative de fraude concernant votre déclaration.\n".
        "Date de déclaration:".$declaration->getDateDeclaration()."\n".
        "Nom : $prenom $nom\nRaison : $typeFraude\n".
        "Cette fraude sera poursuivie conformément aux lois en vigueur.\n".
        "Merci de rester disponible pour toute démarche légale.";
        





        $twilioSid = $_ENV['TWILIO_ACCOUNT_SID'];
        $twilioToken = $_ENV['TWILIO_AUTH_TOKEN'];
        $fromNumber = $_ENV['TWILIO_PHONE_NUMBER'];
        $smsService = new SmsService();
        $smsService->init($twilioSid, $twilioToken, $fromNumber);
        $smsService->send($declaration->getUser()->getNumeroTelephone(), $message);
        return $this->redirectToRoute('admin_declaration_revenus_index');
    }   
    
}


