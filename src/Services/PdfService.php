<?php

namespace App\Services;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfService
{
    public function generatePdf(string $html, string $filename): void
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

        // Set the Content-Type header to indicate that the response is a PDF
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . $filename . '"'); // Display in browser
        header('Content-Disposition: attachment; filename="' . $filename . '"'); // Force download

        // Output the generated PDF
        echo $dompdf->output();
    }
}