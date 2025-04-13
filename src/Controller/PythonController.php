<?php

namespace App\Controller;
use Psr\Log\LoggerInterface;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PythonController extends ApiController
{
    private $logger;

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
        $data = json_decode($request->getContent(), true);

        // Validate input
        if (empty($data['query'])) {
            return $this->json(['error' => 'Missing query parameter'], 400);
        }

        // Execute query script
        $result = $this->executePythonScript(
            'Test',
            [$data['query']],
            null,
            [],
            $this->getParameter('python_script_dir')
        );

        // Handle response
        if (!$result['success']) {
            return $this->json([
                'error' => 'Query failed',
                'details' => $result['error']
            ], 500);
        }

        return $this->json([
            'query' => $data['query'],
            'response' => trim($result['output'])
        ]);
    }
}
