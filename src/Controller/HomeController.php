<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/back', name: 'dashboard')]
    public function index2(): Response
    {
        return $this->render('home/index2.html.twig');
    }
    
    #[Route('/', name: 'home')]
    public function index3(): Response
    {
        return $this->render('home/index.html.twig');
    }
    
}
