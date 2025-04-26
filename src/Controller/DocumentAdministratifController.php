<?php

namespace App\Controller;

use App\Entity\Documentadministratif;
use App\Form\DocumentAdministratifType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Services\PdfService;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


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
    #[Route('/back', name: 'document_index_back', methods: ['GET'])]
    public function index1(EntityManagerInterface $entityManager): Response
    {
        $documents = $entityManager->getRepository(Documentadministratif::class)->findAll();

        return $this->render('document/indexback.html.twig', [
            'documents' => $documents,
        ]);
    }
    #[Route('/prompt', name: 'document_pdf_gen', methods: ['GET'])]
    public function index2(EntityManagerInterface $entityManager): Response
    {
        $documents = $entityManager->getRepository(Documentadministratif::class)->findAll();

        return $this->render('document/generatepdf.html.twig', [
            'documents' => $documents,
        ]);
    }

    #[Route('/new', name: 'document_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
      
        $document = new Documentadministratif();
          // Set the default status to "Brouillon"
          $document->setStatus('Brouillon');
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
        // Set the default status to "Brouillon"
        if ($document->getStatus() !== 'Brouillon') {
            throw $this->createAccessDeniedException('Vous ne pouvez pas modifier ce document.');
        }else{
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
    }

        return $this->render('document/edit.html.twig', [
            'document' => $document,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'document_delete', methods: ['POST'])]
    public function delete(Request $request, Documentadministratif $document, EntityManagerInterface $entityManager): Response
    {
         // Set the default status to "Brouillon"
         if ($document->getStatus() !== 'Brouillon') {
            throw $this->createAccessDeniedException('Vous ne pouvez pas supprimer ce document.');
        }else{
        if ($this->isCsrfTokenValid('delete'.$document->getId(), $request->request->get('_token'))) {
            $entityManager->remove($document);
            $entityManager->flush();
        }
    }
        return $this->redirectToRoute('document_index');
    }
    #[Route('/{id}/back', name: 'document_delete_back', methods: ['POST'])]
    public function delete_back(Request $request, Documentadministratif $document, EntityManagerInterface $entityManager): Response
    {
         
        if ($this->isCsrfTokenValid('delete'.$document->getId(), $request->request->get('_token'))) {
            $entityManager->remove($document);
            $entityManager->flush();
        }
    
        return $this->redirectToRoute('document_index_back');
    }

    #[Route('/pdf/{id}', name: 'document_pdf')]
public function generatePdf(Documentadministratif $document, PdfService $pdfService): Response
{
      // Prepare the HTML content for the PDF
      $html = $this->renderView('document/pdf.html.twig', [
        'document' => $document,
    ]);

    // Generate the PDF content
    $pdfContent = $pdfService->generatePdf($html, sprintf('document_%d.pdf', $document->getId()));

    // Create a response to stream the PDF
    $response = new Response($pdfContent);

    // Set headers for the PDF file
    $response->headers->set('Content-Type', 'application/pdf');
    $response->headers->set('Content-Disposition', sprintf('inline; filename="%s"', sprintf('document_%d.pdf', $document->getId())));

    // Return the response
    return $response;
}
#[Route('/document/{id}/status', name: 'document_status')]
public function status(Documentadministratif $document): Response
{
    return $this->render('document/status.html.twig', [
        'document' => $document,
    ]);
}
#[Route('/document/{id}/modify-status', name: 'document_modify_status', methods: ['GET', 'POST'])]
public function modifyStatus(Request $request, Documentadministratif $document, EntityManagerInterface $entityManager): Response
{
    
    $form = $this->createFormBuilder()
        ->add('status', ChoiceType::class, [
            'choices' => [
                'Validé' => 'Validé',
                'Archivé' => 'Archivé',
                'Rejeté' => 'Rejeté',
            ],
            'label' => 'Choisissez un nouveau statut',
        ])
        ->getForm();

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $newStatus = $form->get('status')->getData();

        // Update the document's status
        $document->setStatus($newStatus);
        $entityManager->flush();

        $this->addFlash('success', 'Le statut du document a été modifié avec succès.');

        return $this->redirectToRoute('document_index_back');
    }

    return $this->render('document/status_modify.html.twig', [
        'form' => $form->createView(),
        'document' => $document,
    ]);
}

}
