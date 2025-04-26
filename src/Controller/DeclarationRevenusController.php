<?php

namespace App\Controller;

use App\Entity\DeclarationRevenus;
use App\Entity\Utilisateur;
use App\Form\DeclarationRevenusType;
use App\Repository\DeclarationRevenusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use thiagoalessio\TesseractOCR\TesseractOCR;

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

                $spreadsheet = IOFactory::load($this->getParameter('kernel.project_dir') . '/public/Salary.xlsx');
                $worksheet = $spreadsheet->getActiveSheet();
                
                $isSuspected = false;
                $userJob = $declaration->getSourceRevenu();  
                $userRevenue = $declaration->getMontantRevenu(); 

                foreach ($worksheet->getRowIterator() as $row) {
                    $rowIndex = $row->getRowIndex();
                    $jobCell = $worksheet->getCell('A' . $rowIndex);
                    $revenueCell = $worksheet->getCell('B' . $rowIndex);
                
                    $job = trim($jobCell->getValue());
                    $averageRevenue = floatval(str_replace(',', '', $revenueCell->getValue()));
                
                    if (strtolower($userJob) === strtolower($job) && $userRevenue < 0.5 * $averageRevenue) {
                        $isSuspected = true;
                        break;
                    }
                }
                

                // Set the `is_suspected` field based on the comparison
                $declaration->setIsSuspected($isSuspected ? 1 : 0);
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
    #[Route('/extract-ocr', name: 'app_declaration_extract_ocr', methods: ['POST'])]
    public function extractOCR(Request $request, SluggerInterface $slugger): JsonResponse
    {
        $file = $request->files->get('image');
        if (!$file) {
            return new JsonResponse(['error' => 'No file provided'], 400);
        }
    
        $filePath = $this->uploadFile($file, $slugger);
        if (!$filePath) {
            return new JsonResponse(['error' => 'File upload failed'], 500);
        }
    
        $absolutePath = $this->getParameter('kernel.project_dir') . '/public/' . $filePath;
        $ocr = new TesseractOCR($absolutePath);
        $extractedText = $ocr->run();
    
        $source = $this->guessSourceFromText($extractedText);
        $montantRevenu = $this->extractMontantRevenuFromText($extractedText);
    
        return new JsonResponse([
            'source' => $source,
            'text' => $extractedText, 
            'montant' => $montantRevenu,
        ]);
    }

    private function extractMontantRevenuFromText(string $text): ?float
{
    // Convert to lowercase for uniformity
    $text = strtolower($text);

    // Check for 'basic salary'
    if (stripos($text, 'basic salary') !== false) {
        // Find the position of 'basic salary'
        $salaryPos = stripos($text, 'basic salary');

        // Extract the substring after 'basic salary'
        $substring = substr($text, $salaryPos + strlen('basic salary'));

        // Trim any leading spaces and remove colons
        $substring = ltrim($substring);
        $substring = str_replace(":", "", $substring);

        // Now, get up to the newline or end of digit sequence
        $endPos = strpos($substring, "\n");
        if ($endPos !== false) {
            $substring = substr($substring, 0, $endPos);
        }

        // Remove any non-digit characters except . , and space
        if (preg_match('/([\d\s,\.]+)/', $substring, $matches)) {
            $rawAmount = $matches[1];

            // Remove spaces, commas and periods
            $cleaned = preg_replace('/[\s,\.]/', '', $rawAmount);

            return is_numeric($cleaned) ? (float)$cleaned : null;
        }
    }

    // Default return if not found
    return null;
}




    private function guessSourceFromText(string $text): string
    {
    // Convert the text to lowercase for case-insensitive matching
    $text = strtolower($text);

    // Check for 'emploi'
    if (stripos($text, 'emploi') !== false) {
        // Find the position of 'emploi'
        $emploiPos = stripos($text, 'emploi');

        // Extract the substring after 'emploi'
        $substring = substr($text, $emploiPos + strlen('emploi'));

        // Trim any leading spaces and remove colons
        $substring = ltrim($substring);
        $substring = str_replace(":", "", $substring); // Remove colons

        // Now, get the first word or stop at \n
        $endPos = strpos($substring, "\n");
        if ($endPos !== false) {
            // Extract up to the newline
            $substring = substr($substring, 0, $endPos);
        } else {
            // Check for space and concatenate if necessary
            $words = explode(' ', $substring);
            $substring = implode(' ', $words);
        }

        // Return the cleaned and extracted substring
        return trim($substring);
    }

    // Check for 'designation'
    if (stripos($text, 'designation') !== false) {
        // Find the position of 'designation'
        $designationPos = stripos($text, 'designation');

        // Extract the substring after 'designation'
        $substring = substr($text, $designationPos + strlen('designation'));

        // Trim any leading spaces and remove colons
        $substring = ltrim($substring);
        $substring = str_replace(":", "", $substring); // Remove colons

        // Now, get the first word or stop at \n
        $endPos = strpos($substring, "\n");
        if ($endPos !== false) {
            // Extract up to the newline
            $substring = substr($substring, 0, $endPos);
        } else {
            // Check for space and concatenate if necessary
            $words = explode(' ', $substring);
            $substring = implode(' ', $words);
        }

        // Return the cleaned and extracted substring
        return trim($substring);
    }

    // Default return if no relevant designation is found
    return 'Inconnu';
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
