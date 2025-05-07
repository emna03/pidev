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
final class DeclarationRevenusController extends AbstractController{

    #[Route(name: 'app_declaration_revenus_index', methods: ['GET'])]
    public function index(DeclarationRevenusRepository $declarationRevenusRepository): Response
    {
        return $this->render('declaration_revenus/index.html.twig', [
            'declaration_revenuses' => $declarationRevenusRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_declaration_revenus_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ManagerRegistry $doctrine, SluggerInterface $slugger): Response
    {
        $entityManager = $doctrine->getManager();
        $declaration = new DeclarationRevenus();
        $form = $this->createForm(DeclarationRevenusType::class, $declaration);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('preuve_revenu')->getData();
            $user = $entityManager->getRepository(Utilisateur::class)->find(1); // Replace '1' with a valid user ID.
            $declaration->setUser($user);
                    if ($file) {
                // Call the helper function to upload the file and get the path
                $filePath = $this->uploadFile($file, $slugger);
                
                if ($filePath) {
                    // Save the file path in the entity
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
        return $this->render('declaration_revenus/show.html.twig', [
            'declaration_revenu' => $declarationRevenu,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_declaration_revenus_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DeclarationRevenus $declarationRevenu, EntityManagerInterface $entityManager): Response
    {
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
        if ($this->isCsrfTokenValid('delete'.$declarationRevenu->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($declarationRevenu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_declaration_revenus_index', [], Response::HTTP_SEE_OTHER);
    }
    private function uploadFile(UploadedFile $file, SluggerInterface $slugger): ?string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $slugger->slug($originalFilename); // Slugify the file name
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
    
}

