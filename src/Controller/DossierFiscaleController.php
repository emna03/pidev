<?php

namespace App\Controller;

use App\Entity\DossierFiscale;
use App\Form\DossierFiscaleType;
use App\Repository\DossierFiscaleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

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

    #[Route('/new', name: 'app_dossier_fiscale_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $dossierFiscale = new DossierFiscale();
        $dossierFiscale->setDateCreation((new \DateTime())->format('Y-m-d'));

        $form = $this->createForm(DossierFiscaleType::class, $dossierFiscale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($dossierFiscale);
            $entityManager->flush();

            return $this->redirectToRoute('admin_dossier_fiscale_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('/admin/dossier_fiscale/new.html.twig', [
            'dossier_fiscale' => $dossierFiscale,
            'form' => $form,
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

    #[Route('/{id}', name: 'app_dossier_fiscale_delete', methods: ['POST'])]
    public function delete(Request $request, DossierFiscale $dossierFiscale, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dossierFiscale->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($dossierFiscale);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_dossier_fiscale_index', [], Response::HTTP_SEE_OTHER);
    }

    // Admin Routes
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
}
