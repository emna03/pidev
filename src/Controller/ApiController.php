<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

abstract class ApiController extends AbstractController
{
    protected function executePythonScript(
        string $scriptName,
        array $params = [],
        ?string $input = null,
        array $envVars = [],
        ?string $workingDirectory = null  // Added working directory parameter
    ): array {
        // Use PYTHON_SCRIPT_DIR instead of kernel.project_dir
        $scriptPath = $this->getParameter('python_script_dir') . "/{$scriptName}.py";
        
        // Verify script exists on E: drive
        if (!file_exists($scriptPath)) {
            return [
                'success' => false,
                'error' => "Script {$scriptName}.py not found in " . 
                           $this->getParameter('python_script_dir')
            ];
        }

        $pythonPath = $this->getParameter('python_path');
        $command = array_merge(
            [$pythonPath, $scriptPath],
            array_map('escapeshellarg', $params)  // Sanitize arguments
        );

        // Set working directory to E:/python311_script
        $workingDirectory = $workingDirectory ?? 
                            $this->getParameter('python_script_dir');

        $process = new Process(
            $command,
            $workingDirectory,  // Explicit working directory
            $envVars,           // Pass environment variables
            $input,
            null
        );

        $process->setTimeout($this->getParameter('python_script_timeout'));

        try {
            $process->mustRun();
        } catch (ProcessFailedException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'output' => $process->getErrorOutput(),  // Capture stderr
                'exit_code' => $process->getExitCode()
            ];
        }

        return [
            'success' => true,
            'output' => $process->getOutput(),
            'error_output' => $process->getErrorOutput()  // Added error output
        ];
    }
}