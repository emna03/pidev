<?php

namespace App\Controller;

use App\Entity\Documentadministratif;
use App\Form\DocumentadministratifType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Services\PdfService;

#[Route('/document')]
class DocumentAdministratifController extends AbstractController
{
    #[Route('/', name: 'document_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $documents = $entityManager->getRepository(Documentadministratif::class)->findAll();

        return $this->render('document/index.html.twig', [
            'documents' => $documents,
        ]);
    }

    #[Route('/new', name: 'document_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $document = new Documentadministratif();
        $form = $this->createForm(DocumentadministratifType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $file */
            $file = $form->get('cheminFichier')->getData();

            if ($file) {
                $uploadsDirectory = $this->getParameter('uploads_directory');
                $newFilename = uniqid().'.'.$file->guessExtension();

                try {
                    $file->move($uploadsDirectory, $newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'Erreur lors de l\'upload du fichier.');
                    return $this->redirectToRoute('document_new');
                }

                // Set the file path in the entity
                $document->setCheminFichier($newFilename);
            }

            $entityManager->persist($document);
            $entityManager->flush();

            return $this->redirectToRoute('document_index');
        }

        return $this->render('document/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/{id}', name: 'document_show', methods: ['GET'])]
    public function show(Documentadministratif $document): Response
    {
        return $this->render('document/show.html.twig', [
            'document' => $document,
        ]);
    }

    #[Route('/{id}/edit', name: 'document_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Documentadministratif $document, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DocumentadministratifType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('cheminFichier')->getData();

            if ($file) {
                $uploadsDirectory = $this->getParameter('uploads_directory');
                $newFilename = uniqid().'.'.$file->guessExtension();

                try {
                    $file->move($uploadsDirectory, $newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'Erreur lors de l\'upload du fichier.');
                    return $this->redirectToRoute('document_new');
                }

                // Set the file path in the entity
                $document->setCheminFichier($newFilename);
            }
            $entityManager->flush();

            return $this->redirectToRoute('document_index');
        }

        return $this->render('document/edit.html.twig', [
            'document' => $document,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'document_delete', methods: ['POST'])]
    public function delete(Request $request, Documentadministratif $document, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$document->getId(), $request->request->get('_token'))) {
            $entityManager->remove($document);
            $entityManager->flush();
        }

        return $this->redirectToRoute('document_index');
    }

    #[Route('/pdf/{id}', name: 'document_pdf')]
public function generatePdf(Documentadministratif $document, PdfService $pdfService): Response
{
    // Prepare the HTML content for the PDF
    $html = $this->renderView('document/pdf.html.twig', [
        'document' => $document,
    ]);

    // Generate the PDF
    $pdfService->generatePdf($html, sprintf('document_%d.pdf', $document->getId()));

    // No need to return a response since the PDF is streamed directly
    return new Response('', 200);
}

}
