<?php

namespace App\Controller;

use App\Entity\DeclarationRevenus;
use App\Entity\Utilisateur;
use App\Form\DeclarationRevenusType;
use App\Repository\DeclarationRevenusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/declaration')]
final class DeclarationRevenusController extends AbstractController
{
    // Routes for user-facing declarations
    #[Route(name: 'app_declaration_revenus_index', methods: ['GET'])]
    public function index(DeclarationRevenusRepository $declarationRevenusRepository): Response
    {
        $user = $this->getUser();
        if (!$user instanceof Utilisateur) {
            throw $this->createAccessDeniedException('You must be logged in.');
        }

        return $this->render('declaration_revenus/index.html.twig', [
            'declaration_revenuses' => $declarationRevenusRepository->findBy(['user' => $user]),
        ]);
    }

    #[Route('/new', name: 'app_declaration_revenus_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ManagerRegistry $doctrine, SluggerInterface $slugger): Response
    {
        $user = $this->getUser();
        if (!$user instanceof Utilisateur) {
            throw $this->createAccessDeniedException('You must be logged in to declare your revenue.');
        }

        $entityManager = $doctrine->getManager();
        $declaration = new DeclarationRevenus();
        $declaration->setDateDeclaration((new \DateTime())->format('Y-m-d'));
        $declaration->setUser($user);

        $form = $this->createForm(DeclarationRevenusType::class, $declaration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('preuve_revenu')->getData();

            if ($file) {
                $filePath = $this->uploadFile($file, $slugger);
                if ($filePath) {
                    $declaration->setPreuveRevenu($filePath);
                }
            }

            $entityManager->persist($declaration);
            $entityManager->flush();

            return $this->redirectToRoute('app_declaration_revenus_index');
        }

        return $this->render('declaration_revenus/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_declaration_revenus_show', methods: ['GET'])]
    public function show(DeclarationRevenus $declarationRevenu): Response
    {
        $user = $this->getUser();
        if ($declarationRevenu->getUser() !== $user) {
            throw $this->createAccessDeniedException('You are not allowed to view this declaration.');
        }

        return $this->render('declaration_revenus/show.html.twig', [
            'declaration_revenu' => $declarationRevenu,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_declaration_revenus_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DeclarationRevenus $declarationRevenu, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if ($declarationRevenu->getUser() !== $user) {
            throw $this->createAccessDeniedException('You are not allowed to edit this declaration.');
        }

        $form = $this->createForm(DeclarationRevenusType::class, $declarationRevenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_declaration_revenus_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('declaration_revenus/edit.html.twig', [
            'declaration_revenu' => $declarationRevenu,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_declaration_revenus_delete', methods: ['POST'])]
    public function delete(Request $request, DeclarationRevenus $declarationRevenu, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if ($declarationRevenu->getUser() !== $user) {
            throw $this->createAccessDeniedException('You are not allowed to delete this declaration.');
        }

        if ($this->isCsrfTokenValid('delete' . $declarationRevenu->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($declarationRevenu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_declaration_revenus_index', [], Response::HTTP_SEE_OTHER);
    }

    // Upload helper method
    private function uploadFile(UploadedFile $file, SluggerInterface $slugger): ?string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $slugger->slug($originalFilename);
        $newFilename = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();

        try {
            $file->move(
                $this->getParameter('uploads_directory'),
                $newFilename
            );

            return 'uploads/' . $newFilename;
        } catch (FileException $e) {
            return null;
        }
    }

    #[Route('/admin/declarations', name: 'admin_declaration_revenus_index', methods: ['GET'])]
    public function adminIndex(DeclarationRevenusRepository $declarationRevenusRepository): Response
    {
        return $this->render('admin/declaration_revenus/index.html.twig', [
            'declarations' => $declarationRevenusRepository->findAll(),
        ]);
    }

    #[Route('/admin/{id}', name: 'admin_declaration_revenus_show', methods: ['GET'])]
    public function adminShow(DeclarationRevenus $declarationRevenu): Response
    {
        return $this->render('admin/declaration_revenus/show.html.twig', [
            'declaration_revenu' => $declarationRevenu,
        ]);
    }

    #[Route('/admin/{id}/edit', name: 'admin_declaration_revenus_edit', methods: ['GET', 'POST'])]
    public function adminEdit(Request $request, DeclarationRevenus $declarationRevenu, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DeclarationRevenusType::class, $declarationRevenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_declaration_revenus_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/declaration_revenus/edit.html.twig', [
            'declaration_revenu' => $declarationRevenu,
            'form' => $form,
        ]);
    }

    #[Route('/admin/{id}', name: 'admin_declaration_revenus_delete', methods: ['POST'])]
    public function adminDelete(Request $request, DeclarationRevenus $declarationRevenu, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $declarationRevenu->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($declarationRevenu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_declaration_revenus_index', [], Response::HTTP_SEE_OTHER);
    }
}
