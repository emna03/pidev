<?php

namespace App\Controller;

use App\Entity\Quartier;
use App\Form\QuartierType;
use App\Repository\QuartierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/quartier')]
class QuartierController extends AbstractController
{#[Route('/', name: 'app_quartier_index', methods: ['GET'])]
    public function index(Request $request, QuartierRepository $quartierRepository): Response
    {
        $search = $request->query->get('search', '');
        $min = (float) $request->query->get('min', 0);
        $max = (float) $request->query->get('max', 5000);
    
        $quartiers = $quartierRepository->findWithFilters($search, $min, $max);
    
        return $this->render('quartier/index.html.twig', [
            'quartiers' => $quartiers,
            'search' => $search,
            'min' => $min,
            'max' => $max,
        ]);
    }
    

    #[Route('/new', name: 'app_quartier_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $quartier = new Quartier();
        $form = $this->createForm(QuartierType::class, $quartier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($quartier);
            $entityManager->flush();

            return $this->redirectToRoute('app_quartier_index');
        }

        return $this->render('quartier/new.html.twig', [
            'quartier' => $quartier,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_quartier_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Quartier $quartier, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(QuartierType::class, $quartier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_quartier_index');
        }

        return $this->render('quartier/edit.html.twig', [
            'quartier' => $quartier,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_quartier_delete', methods: ['POST'])]
    public function delete(Request $request, Quartier $quartier, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quartier->getId(), $request->request->get('_token'))) {
            $entityManager->remove($quartier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_quartier_index');
    }
    #[Route('/show-all', name: 'app_quartier_show_all', methods: ['GET'])]
    public function showAll(Request $request, QuartierRepository $quartierRepository): Response
    {
        $search = $request->query->get('search', '');
        $min = (float) $request->query->get('min', 0);
        $max = (float) $request->query->get('max', 5000);
    
        $quartiers = $quartierRepository->findWithFilters($search, $min, $max);
    
        return $this->render('quartier/show_all.html.twig', [
            'quartiers' => $quartiers,
            'search' => $search,
            'min' => $min,
            'max' => $max,
        ]);
    }
    
#[Route('/show/{id}', name: 'app_quartier_show', methods: ['GET'])]
public function show(Quartier $quartier, EntityManagerInterface $entityManager): Response
{
    $lampadaires = $entityManager->getRepository(\App\Entity\Lampadaire::class)
        ->findBy(['quartier' => $quartier]);

    return $this->render('quartier/show.html.twig', [
        'quartier' => $quartier,
        'lampadaires' => $lampadaires,
    ]);
}




    
#[Route('/showA/{id}', name: 'app_quartier_showA', methods: ['GET'])]
public function showA(Quartier $quartier, EntityManagerInterface $entityManager): Response
{
    $lampadaires = $entityManager->getRepository(\App\Entity\Lampadaire::class)
        ->findBy(['quartier' => $quartier]);

    return $this->render('quartier/showA.html.twig', [
        'quartier' => $quartier,
        'lampadaires' => $lampadaires,
    ]);
}


}