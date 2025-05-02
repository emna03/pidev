<?php

namespace App\Controller;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Documentadministratif;
use Symfony\Component\HttpFoundation\Response;
use App\Services\PdfService;

class PythonController extends ApiController
{

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

/**
 * Translation endpoint using traduction_siwar.py
 */
/**
 * Translation endpoint using translate.py
 */
#[Route('/api/python/translate', name: 'api_python_translate', methods: ['POST'])]
public function translate(Request $request): JsonResponse
{
    $data = json_decode($request->getContent(), true);

    // Validate input
    if (empty($data['text']) || !is_string($data['text'])) {
        return $this->json(['error' => 'Invalid input: "text" string required'], 400);
    }

    $text = $data['text'];

    // Log the received text
    $this->logger->info('Translation Request Received', ['text' => $text]);

    try {
        $result = $this->executePythonScript(
            'traduction_siwar', // Script name (without .py extension)
            [$text],     // Pass the raw text directly
            null,
            [],
            $this->getParameter('python_script_dir')
        );
    } catch (\Exception $e) {
        $this->logger->error('Error executing Python script', [
            'exception' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        return $this->json(['error' => 'Internal server error'], 500);
    }

    // Log the result for debugging
    $this->logger->info('Python Script Result', [
        'success' => $result['success'],
        'output' => $result['output'] ?? '',
        'error_output' => $result['error_output'] ?? ''
    ]);

    if (!$result['success']) {
        $this->logger->error('Python Script Failed', [
            'output' => $result['output'] ?? '',
            'error' => $result['error'] ?? ''
        ]);
        return $this->json(['error' => $result['error'] ?? 'Translation failed'], 500);
    }

    // Extract the translated text
    $translatedText = trim($result['output'] ?? ''); // Plain text output from the Python script

    // Ensure the output contains the "Translated:" prefix and extract the actual translation
    if (strpos($translatedText, 'Translated:') === false) {
        $this->logger->error('Unexpected Python Script Output', ['output' => $translatedText]);
        return $this->json(['error' => 'Unexpected translation output'], 500);
    }

    // Strip the "✅ Translated:" prefix to get the clean translation
    $translatedText = trim(str_replace('Translated:', '', $translatedText));

    return $this->json(['translation' => $translatedText]);
}
    /**
     * Query endpoint using test.py
     */





    #[Route('/api/python/query', name: 'api_python_query', methods: ['POST'])]
    public function query(Request $request): JsonResponse
    {
        try {
            // Log incoming request content
            $rawContent = $request->getContent();
            $this->logger->info('Incoming request content: ' . $rawContent);
    
            // Decode JSON
            $data = json_decode($rawContent, true);
            
            // Check for JSON decoding errors
            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->logger->error('JSON decoding error: ' . json_last_error_msg());
                return $this->json(['error' => 'Invalid JSON format'], 400);
            }
    
            // Validate input
            if (empty($data['query'])) {
                $this->logger->warning('Missing query parameter');
                return $this->json(['error' => 'Missing query parameter'], 400);
            }
    
            // Log query execution attempt
            $this->logger->info('Executing Python script with query: ' . $data['query']);
    
            // Execute script
            $result = $this->executePythonScript3(
                'Test',
                [$data['query']],
                null,
                [],
                $this->getParameter('python_script_dir')
            );
    
            // Check script result
            if (!$result['success']) {
                $this->logger->error('Python script failed: ' . $result['error']);
                return $this->json([
                    'error' => 'Query failed',
                    'details' => $result['error']
                ], 500);
            }
    
            // Log final response
            $this->logger->info('Python script response: ' . $result['output']);
             // Validate encoding before creating response
        if (!mb_check_encoding($result['output'], 'UTF-8')) {
            $this->logger->warning('Fixing invalid UTF-8 in output');
            $result['output'] = mb_convert_encoding(
                $result['output'],
                'UTF-8',
                'UTF-8',
                'IGNORE' // Discard invalid characters
            );
        }

        return $this->json([
            'query' => $data['query'],
            'response' => trim($result['output'])
        ]);
        } catch (\Exception $e) {
            $this->logger->critical('Unexpected error: ' . $e->getMessage());
            return $this->json(['error' => 'Internal server error'], 500);
        }
    }

    



    #[Route('/api/python/image', name: 'api_python_image', methods: ['POST'])]
    public function addFromImage(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        // Get the uploaded file
        /** @var UploadedFile $file */
        $file = $request->files->get('image');
        if (!$file) {
            $this->logger->warning('No File Uploaded');
            return $this->json(['success' => false, 'error' => 'No file uploaded'], 400);
        }
    
        // Save the file temporarily
        $uploadsDirectory = $this->getParameter('uploads_directory');
        $newFilename = uniqid() . '.' . $file->guessExtension();
        try {
            $file->move($uploadsDirectory, $newFilename);
        } catch (\Exception $e) {
            $this->logger->error('File Upload Failed', [
                'exception' => $e->getMessage(),
            ]);
            return $this->json(['success' => false, 'error' => 'File upload failed'], 500);
        }
    
        // Log the uploaded file path
        $filePath = str_replace('\\', '/', $uploadsDirectory . '/' . $newFilename);
        $this->logger->info('Uploaded File Path', ['path' => $filePath]);
    
        // Log the OCR script execution details
        $this->logger->info('Executing OCR Script', [
            'script' => 'ocr',
            'params' => [$filePath],
        ]);
    
        // Call the OCR script to extract text
        try {
            $result = $this->executePythonScript2(
                'ocr', // Script name (without .py extension)
                [$filePath], // Pass the image path as an argument
                null,
                [],
                $this->getParameter('python_script_dir')
            );
        } catch (\Exception $e) {
            $this->logger->error('OCR Processing Failed', [
                'exception' => $e->getMessage(),
            ]);
            return $this->json(['success' => false, 'error' => 'OCR processing failed'], 500);
        }
    
        if (!$result['success']) {
            return $this->json(['success' => false, 'error' => 'OCR failed'], 500);
        }
    
        // Parse the JSON output
        $ocrOutput = trim($result['output'] ?? '');
        if (empty($ocrOutput)) {
            return $this->json(['success' => false, 'error' => 'No text extracted'], 500);
        }
    
        $parsedData = json_decode($ocrOutput, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->json(['success' => false, 'error' => 'Invalid OCR output format'], 500);
        }
    
        // Extract parsed fields
        $nomDocument = $parsedData['nomDocument'] ?? '';
        $statut = $parsedData['statut'] ?? '';
        $remarque = $parsedData['remarque'] ?? '';
    
        // Validate required fields
        if (empty($nomDocument)) {
            return $this->json(['success' => false, 'error' => 'Document name is missing'], 400);
        }
    
        // Create a new Documentadministratif entity
        $document = new Documentadministratif();
        $document->setNomDocument($nomDocument); // Default name for OCR-based documents
        $document->setCheminFichier($newFilename); // Set the uploaded file path
        $document->setStatus($statut); // Set the default status
        $document->setRemarque($remarque); // Use the OCR text as the remark
    
        // Persist the document
        try {
            $entityManager->persist($document);
            $entityManager->flush();
        } catch (\Exception $e) {
            $this->logger->error('Failed to Save Document to Database', [
                'exception' => $e->getMessage(),
            ]);
            return $this->json(['success' => false, 'error' => 'Failed to save document to database'], 500);
        }
    
        // Log the successful creation of the document
        $this->logger->info('Document Created Successfully', [
            'document_id' => $document->getId(),
            'filename' => $newFilename,
        ]);
    
        return $this->json(['success' => true]);
    }
    #[Route('/api/generate-pdf', name: 'api_generate_pdf', methods: ['POST'])]
    public function generatePdfFromText(Request $request, PdfService $pdfService): Response
    {
        // Log the raw request content
        $rawContent = $request->getContent();
        $this->logger->info('Generate PDF Request Received', [
            'raw_content' => $rawContent,
        ]);
    
        // Decode JSON and log the result
        $data = json_decode($rawContent, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->logger->error('Invalid JSON Format', [
                'json_error' => json_last_error_msg(),
                'raw_content' => $rawContent,
            ]);
            return $this->json(['error' => 'Invalid JSON format'], 400);
        }
    
        // Validate the 'text' field
        if (empty($data['text']) || !is_string($data['text'])) {
            $this->logger->error('Missing or Invalid "text" Field', [
                'data' => $data,
            ]);
            return $this->json(['error' => 'Missing or invalid "text" field'], 400);
        }
    
        // Log the received text
        $this->logger->info('Parsing Structured Text', [
            'text' => $data['text'],
        ]);
    
        // Parse the text into fields
        $parsedData = $this->parseStructuredText($data['text']);
        $this->logger->info('Parsed Data', [
            'parsed_data' => $parsedData,
        ]);
        if (!$parsedData) {
            $this->logger->error('Failed to Parse Text', [
                'text' => $data['text'],
            ]);
            return $this->json(['error' => 'Invalid text format'], 400);
        }
    
        // Log parsed data
        $this->logger->info('Parsed Data', [
            'parsed_data' => $parsedData,
        ]);
    
        // Generate HTML for the PDF
        $html = $this->renderView('document/pdf_template.html.twig', [
            'data' => $parsedData,
        ]);
    
        // Log the generated HTML
        $this->logger->info('Generated HTML for PDF', [
            'html' => $html,
        ]);
    
        // Generate the PDF
        try {
            $pdfContent = $pdfService->generatePdf($html, 'generated_document.pdf');
        } catch (\Exception $e) {
            $this->logger->error('PDF Generation Failed', [
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return $this->json(['error' => 'PDF generation failed'], 500);
        }
    
        // Log successful PDF generation
        $this->logger->info('PDF Generated Successfully');
    
        // Return the PDF as a downloadable response
        return new Response(
            $pdfContent,
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="generated_document.pdf"',
            ]
        );
    }
    private function parseStructuredText(string $text): ?array
    {
        $lines = explode("\n", $text); // Split text into lines
        $data = [
            'titre' => '',
            'nom' => '',
            'prenom' => '',
            'date_naissance' => '',
            'nationalite' => '',
            'description' => '',
        ];
    
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue; // Skip empty lines
    
            // Check for key-value pairs
            if (strpos($line, 'Titre:') === 0) {
                $data['titre'] = trim(substr($line, strlen('Titre:')));
            } elseif (strpos($line, 'Nom:') === 0) {
                $data['nom'] = trim(substr($line, strlen('Nom:')));
            } elseif (strpos($line, 'Prénom:') === 0) {
                $data['prenom'] = trim(substr($line, strlen('Prénom:')));
            } elseif (strpos($line, 'Date de Naissance:') === 0) {
                $data['date_naissance'] = trim(substr($line, strlen('Date de Naissance:')));
            } elseif (strpos($line, 'Nationalité:') === 0) {
                $data['nationalite'] = trim(substr($line, strlen('Nationalité:')));
            } elseif (strpos($line, 'Description:') === 0) {
                $data['description'] = trim(substr($line, strlen('Description:')));
            } else {
                // Handle unknown lines (optional)
                $this->logger->warning('Unknown Line in Input', ['line' => $line]);
            }
        }
    
        // Validate required fields
        if (empty($data['titre']) || empty($data['nom']) || empty($data['prenom'])) {
            $this->logger->error('Missing Required Fields', ['data' => $data]);
            return null;
        }
    
        return $data;
    }
}
