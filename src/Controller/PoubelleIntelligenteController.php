<?php
// src/Controller/PoubelleIntelligenteController.php

namespace App\Controller;

use App\Entity\PoubelleIntelligente;
use App\Form\PoubelleIntelligenteType;
use App\Repository\PoubelleIntelligenteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/poubelle/intelligente')]
class PoubelleIntelligenteController extends AbstractController
{
    #[Route('/', name: 'app_poubelle_intelligente_index', methods: ['GET'])]
    public function index(PoubelleIntelligenteRepository $poubelleIntelligenteRepository): Response
    {
        return $this->render('poubelle_intelligente/index.html.twig', [
            'poubelle_intelligentes' => $poubelleIntelligenteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_poubelle_intelligente_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $poubelleIntelligente = new PoubelleIntelligente();
        $form = $this->createForm(PoubelleIntelligenteType::class, $poubelleIntelligente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($poubelleIntelligente);
            $entityManager->flush();

            return $this->redirectToRoute('app_poubelle_intelligente_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('poubelle_intelligente/new.html.twig', [
            'poubelle_intelligente' => $poubelleIntelligente,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_poubelle_intelligente_show', methods: ['GET'])]
    public function show(PoubelleIntelligente $poubelleIntelligente): Response
    {
        return $this->render('poubelle_intelligente/show.html.twig', [
            'poubelle_intelligente' => $poubelleIntelligente,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_poubelle_intelligente_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PoubelleIntelligente $poubelleIntelligente, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PoubelleIntelligenteType::class, $poubelleIntelligente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_poubelle_intelligente_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('poubelle_intelligente/edit.html.twig', [
            'poubelle_intelligente' => $poubelleIntelligente,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_poubelle_intelligente_delete', methods: ['POST'])]
    public function delete(Request $request, PoubelleIntelligente $poubelleIntelligente, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$poubelleIntelligente->getId(), $request->request->get('_token'))) {
            $entityManager->remove($poubelleIntelligente);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_poubelle_intelligente_index', [], Response::HTTP_SEE_OTHER);
    }
}