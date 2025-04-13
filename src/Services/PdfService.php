<?php

namespace App\Services;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfService
{
    public function generatePdf(string $html, string $filename): string
    {
        // Configure Dompdf options
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
    
        // Initialize Dompdf
        $dompdf = new Dompdf($options);
    
        // Load HTML content
        $dompdf->loadHtml($html);
    
        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');
    
        // Render the HTML as PDF
        $dompdf->render();
    
        // Return the raw PDF content
        return $dompdf->output();
    }
}