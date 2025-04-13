<?php
// src/Controller/LampadaireController.php

namespace App\Controller;

use App\Entity\Lampadaire;
use App\Form\LampadaireType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/lampadaire')]
class LampadaireController extends AbstractController
{
    #[Route('/', name: 'app_lampadaire_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $lampadaires = $entityManager
            ->getRepository(Lampadaire::class)
            ->findAll();

        return $this->render('lampadaire/index.html.twig', [
            'lampadaires' => $lampadaires,
        ]);
    }

    #[Route('/new', name: 'app_lampadaire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $lampadaire = new Lampadaire();
        $form = $this->createForm(LampadaireType::class, $lampadaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($lampadaire);
            $entityManager->flush();

            return $this->redirectToRoute('app_lampadaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lampadaire/new.html.twig', [
            'lampadaire' => $lampadaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lampadaire_show', methods: ['GET'])]
    public function show(Lampadaire $lampadaire): Response
    {
        return $this->render('lampadaire/show.html.twig', [
            'lampadaire' => $lampadaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_lampadaire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Lampadaire $lampadaire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LampadaireType::class, $lampadaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_lampadaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lampadaire/edit.html.twig', [
            'lampadaire' => $lampadaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lampadaire_delete', methods: ['POST'])]
    public function delete(Request $request, Lampadaire $lampadaire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lampadaire->getId(), $request->request->get('_token'))) {
            $entityManager->remove($lampadaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_lampadaire_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/citoyen/lampadaires', name: 'citizen_lampadaire_index', methods: ['GET'])]
public function citizenIndex(EntityManagerInterface $entityManager): Response
{
    $lampadaires = $entityManager
        ->getRepository(Lampadaire::class)
        ->findAll();

    return $this->render('lampadaire/indexc.html.twig', [
        'lampadaires' => $lampadaires,
    ]);
}

#[Route('/citoyen/lampadaires/{id}', name: 'citizen_lampadaire_show', methods: ['GET'])]
public function citizenShow(Lampadaire $lampadaire): Response
{
    return $this->render('lampadaire/showc.html.twig', [
        'lampadaire' => $lampadaire,
    ]);
}

}