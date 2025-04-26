<?php

namespace App\Controller;

use App\Entity\Serviceintervention;
use App\Form\ServiceInterventionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceInterventionController extends AbstractController
{
    #[Route('/admin/service/add', name: 'add_service')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $service = new Serviceintervention();
        $form = $this->createForm(ServiceInterventionType::class, $service);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($service);
            $entityManager->flush();

            $this->addFlash('success', 'Service ajouté avec succès.');

            return $this->redirectToRoute('add_service');
        }

        return $this->render('back/home/addservice.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/service/list', name: 'list_service')]
    public function list(EntityManagerInterface $entityManager): Response
    {
        // Récupérer tous les services depuis la base de données
        $services = $entityManager->getRepository(Serviceintervention::class)->findAll();

        return $this->render('back/home/listservice.html.twig', [
            'services' => $services,
        ]);
    }


#[Route('/admin/service/edit/{id}', name: 'edit_service')]
public function edit(int $id, Request $request, EntityManagerInterface $entityManager): Response
{
    // Récupérer le service existant à partir de son ID
    $service = $entityManager->getRepository(Serviceintervention::class)->find($id);

    // Vérifier si le service existe
    if (!$service) {
        throw $this->createNotFoundException('Le service demandé n\'existe pas.');
    }

    // Créer le formulaire d'édition
    $form = $this->createForm(ServiceinterventionType::class, $service);

    // Traiter la requête du formulaire
    $form->handleRequest($request);

    // Vérifier si le formulaire a été soumis et validé
    if ($form->isSubmitted() && $form->isValid()) {
        // Sauvegarder les changements dans la base de données
        $entityManager->flush();

        // Ajouter un message de succès
        $this->addFlash('success', 'Service modifié avec succès.');

        // Rediriger vers la liste des services
        return $this->redirectToRoute('list_service');
    }

    // Rendre la vue avec le formulaire
    return $this->render('back/home/editservice.html.twig', [
        'form' => $form->createView(),
        'service' => $service
    ]);
}

    #[Route('/admin/service/delete/{id}', name: 'delete_service')]
    public function delete(EntityManagerInterface $entityManager, $id): Response
    {
        $service = $entityManager->getRepository(Serviceintervention::class)->find($id);

        if (!$service) {
            $this->addFlash('error', 'Service introuvable.');
            return $this->redirectToRoute('list_service');
        }

        $entityManager->remove($service);
        $entityManager->flush();

        $this->addFlash('success', 'Service supprimé avec succès.');

        return $this->redirectToRoute('list_service');
    }
}
