<?php

namespace App\Controller;

use App\Entity\Assistantdocumentaire;
use App\Form\AssistantdocumentaireType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\PdfService;
#[Route('/assistantdocumentaire')]
class AssistantDocumentaireController extends AbstractController
{
    #[Route('/', name: 'assistantdocumentaire_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $assistants = $entityManager->getRepository(Assistantdocumentaire::class)->findAll();
        return $this->render('assistant/index.html.twig', [
            'assistants' => $assistants,
        ]);
    }

    #[Route('/new', name: 'assistantdocumentaire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $assistantDocumentaire = new Assistantdocumentaire();
        $form = $this->createForm(AssistantDocumentaireType::class, $assistantDocumentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($assistantDocumentaire);
            $entityManager->flush();

            return $this->redirectToRoute('assistantdocumentaire_index');
        }

        return $this->render('assistant/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'assistantdocumentaire_show', methods: ['GET'])]
    public function show(Assistantdocumentaire $assistant): Response
    {
        return $this->render('assistant/show.html.twig', [
            'assistant' => $assistant,
        ]);
    }

    #[Route('/{id}/edit', name: 'assistantdocumentaire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Assistantdocumentaire $assistant, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AssistantdocumentaireType::class, $assistant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('assistantdocumentaire_index');
        }

        return $this->render('assistant/edit.html.twig', [
            'form' => $form->createView(),
            'assistant' => $assistant,
        ]);
    }

    #[Route('/{id}/delete', name: 'assistantdocumentaire_delete', methods: ['POST'])]
    public function delete(Request $request, Assistantdocumentaire $assistant, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$assistant->getId(), $request->request->get('_token'))) {
            $entityManager->remove($assistant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('assistantdocumentaire_index');
    }
    #[Route('/pdf/{id}', name: 'assistantdocumentaire_pdf')]
public function generatePdf(Assistantdocumentaire $assistant, PdfService $pdfService): Response
{
    // Prepare the HTML content for the PDF
    $html = $this->renderView('assistant/pdf.html.twig', [
        'assistant' => $assistant,
    ]);
    
    // Generate the PDF content
    $pdfContent = $pdfService->generatePdf($html, sprintf('assistant_document_%d.pdf', $assistant->getId()));

    // Create a response to stream the PDF
    $response = new Response($pdfContent);

    // Set headers for the PDF file
    $response->headers->set('Content-Type', 'application/pdf');
    $response->headers->set('Content-Disposition', sprintf('inline; filename="%s"', sprintf('assistant_document_%d.pdf', $assistant->getId())));

    // Return the response
    return $response;
}
    
}
