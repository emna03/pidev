<?php
namespace App\Controller;
use App\Entity\Incident;
use App\Form\IncidentType;
use App\Repository\IncidentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use App\Entity\Utilisateur;

#[Route('/incident')]
class IncidentController extends AbstractController
{
    #[Route('/incidents', name: 'app_incidents')]
    public function index(IncidentRepository $incidentRepository): Response
    {
        $user = $this->getUser();
    $incidents = $incidentRepository->findBy(['user' => $user]);

        // Retourner la vue avec la liste des incidents
        return $this->render('Incident\show.html.twig', [
            'incidents' => $incidents,
        ]);
    }

    #[Route('/new', name: 'app_incident_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $incident = new Incident();
        $form = $this->createForm(IncidentType::class, $incident);
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();
    
            if ($imageFile) {
                $newFilename = uniqid('', true) . '.' . $imageFile->guessExtension();
                $uploadsDirectory = $this->getParameter('uploads_directory');
                $imageFile->move($uploadsDirectory, $newFilename);
                $incident->setImage($newFilename);
    
                // === Appel du script Python selon le type ===
                $imagePath = $uploadsDirectory . DIRECTORY_SEPARATOR . $newFilename;
                $type = $incident->getTypeIncident(); // "Incendie" ou "Accident"
    
                // Choisir le bon script en fonction du type
                if ($type === 'Incendie') {
                    $scriptPath = 'python/analysefire.py';
                } elseif ($type === 'Accident') {
                    $scriptPath = 'python/analyse_danger.py';
                
                
                } else {
                    $scriptPath = null;
                }
                if ($scriptPath) {
                    $process = new Process(['python', $scriptPath, $imagePath]);
                    $process->setTimeout(300); // 5 minutes
                    $process->run();
    
                    if (!$process->isSuccessful()) {
                        throw new ProcessFailedException($process);
                    }
    
                    $outputRaw = $process->getOutput();
                    preg_match('/\{.*\}/s', $outputRaw, $matches);
                    $output = json_decode($matches[0] ?? '{}', true);
    
                    if (isset($output['danger_level'])) {
                        $incident->setDangerLevel((string) $output['danger_level']);
                    } else {
                        $incident->setDangerLevel("0");
                    }
                } else {
                    $incident->setDangerLevel("0"); // Si aucun type reconnu
                }
            }
            $incident->setUser($user);
            $incident->setDateSignalement(new \DateTime());
            $entityManager->persist($incident);
            $entityManager->flush();
    
            return $this->redirectToRoute('app_incidents');
        }
    
        return $this->render('incident/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
#[Route('/incident/{id}', name: 'app_incident_show', requirements: ['id' => '\d+'], methods: ['GET'])]
public function show(int $id, EntityManagerInterface $entityManager): Response
{
    // Récupérer l'incident depuis la base de données
    $incident = $entityManager->getRepository(Incident::class)->find($id);

    // Vérifier si l'incident existe
    if (!$incident) {
        throw $this->createNotFoundException('Incident non trouvé.');
    }

    // Afficher les détails de l'incident
    return $this->render('Incident\details.html.twig', [
        'incident' => $incident,
    ]);
}



#[Route('/{id}/edit', name: 'app_incident_edit')]
public function edit(
    Request $request,
    Incident $incident,
    EntityManagerInterface $entityManager
): Response {
    $form = $this->createForm(IncidentType::class, $incident);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->flush();

        $this->addFlash('success', 'Incident modifié avec succès.');

        return $this->redirectToRoute('app_incidents');
    }

    return $this->render('incident/edit.html.twig', [
        'incident' => $incident,
        'form' => $form->createView(),
    ]);
}

#[Route('/historique', name: 'app_incident_historique', methods: ['GET'])]
public function historique(IncidentRepository $incidentRepository): Response
{
    // Récupérer tous les incidents ou les incidents filtrés (par exemple, ceux qui sont résolus)
    $user = $this->getUser();
    $incidents = $incidentRepository->findBy(['user' => $user]);// Ou une autre requête pour récupérer des incidents filtrés

    // Rendre le template et passer les incidents à celui-ci
    return $this->render('Incident/historique.html.twig', [
        'incidents' => $incidents,
    ]);
}

#[Route('/incident/delete/{id}', name: 'app_incident_delete', methods: ['GET'])]
public function delete(int $id, EntityManagerInterface $entityManager): Response
{
    $incident = $entityManager->getRepository(Incident::class)->find($id);

    if (!$incident) {
        throw $this->createNotFoundException('Incident introuvable.');
    }

    $entityManager->remove($incident);
    $entityManager->flush();

    $this->addFlash('success', 'Incident supprimé avec succès.');

    return $this->redirectToRoute('app_incident_historique'); // Remplace par ta route de liste
}


}
