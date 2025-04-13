<?php
namespace App\Services;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class PythonTranslationService
{
    private string $pythonPath;
    private string $scriptPath;

    public function __construct(string $pythonPath, string $scriptPath)
    {
        $this->pythonPath = $pythonPath;
        $this->scriptPath = $scriptPath;
    }

    public function translate(array $texts, string $model = 'nllb-distilled-1.3B'): array
    {
        // Convert texts to JSON
        $jsonInput = json_encode($texts);
        $sanitizedInput = escapeshellarg($jsonInput); // Prevent injection

        $process = new Process([
            $this->pythonPath,
            $this->scriptPath,
            $sanitizedInput
        ]);

        $process->setTimeout(300); // 5-minute timeout
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // Parse JSON response
        $output = trim($process->getOutput());
        $result = json_decode($output, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException("Invalid response format: " . $output);
        }
 
        return $result;
    }
}