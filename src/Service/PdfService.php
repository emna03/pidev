<?php

namespace App\Service;

use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Knp\Component\Pager\PaginatorInterface;

class PdfService
{
    private $twig;
    private $paginator;
    
    public function __construct(Environment $twig, PaginatorInterface $paginator)
    {
        $this->twig = $twig;
        $this->paginator = $paginator;
    }
    
    /**
     * Generate PDF using Dompdf
     */
    public function generatePdfWithDompdf(string $html, string $filename): Response
    {
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $options->set('isRemoteEnabled', true);
        
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        return new Response(
            $dompdf->output(),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"'
            ]
        );
    }
    
    /**
     * Generate PDF from a Twig template using Dompdf
     */
    public function generatePdfFromTwigWithDompdf(string $template, array $data, string $filename): Response
    {
        $html = $this->twig->render($template, $data);
        return $this->generatePdfWithDompdf($html, $filename);
    }
    
    /**
     * Generate paginated PDF from a collection
     */
    public function generatePaginatedPdf(string $template, $query, array $data, string $filename, int $page = 1, int $limit = 10): Response
    {
        $pagination = $this->paginator->paginate(
            $query,
            $page,
            $limit
        );
        
        $data['pagination'] = $pagination;
        
        $html = $this->twig->render($template, $data);
        return $this->generatePdfWithDompdf($html, $filename);
    }
}