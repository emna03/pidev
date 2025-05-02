<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Psr\Log\LoggerInterface;

abstract class ApiController extends AbstractController
{
    protected $logger; // Change to protected

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
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
    protected function executePythonScript2(
        string $scriptName,
        array $params = [],
        ?string $input = null,
        array $envVars = [],
        ?string $workingDirectory = null
    ): array {
        $scriptPath = $this->getParameter('python_script_dir') . "/{$scriptName}.py";
        if (!file_exists($scriptPath)) {
            return ['success' => false, 'error' => "Script not found: $scriptPath"];
        }
    
        $pythonPath = $this->getParameter('python_path');
    
        // Remove escapeshellarg() here
        $command = array_merge([$pythonPath, $scriptPath], $params);
    
        $process = new Process(
            $command,
            $workingDirectory ?? $this->getParameter('python_script_dir'),
            $envVars,
            $input,
            null
        );
    
        $process->setTimeout($this->getParameter('python_script_timeout'));
    
        try {
            $process->mustRun();
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'output' => $process->getErrorOutput(),
                'exit_code' => $process->getExitCode()
            ];
        }
    
        return [
            'success' => true,
            'output' => $process->getOutput(),
            'error_output' => $process->getErrorOutput()
        ];
    }
    protected function executePythonScript3(
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
         // Add encoding enforcement here
    $output = mb_convert_encoding(
        $process->getOutput(),
        'UTF-8',
        ['UTF-8', 'ISO-8859-1', 'Windows-1252'] // Common encodings to check
    );

   
        return [
            'success' => true,
            'output' =>  $output,
            'error_output' => $process->getErrorOutput()  // Added error output
        ];
    }
}