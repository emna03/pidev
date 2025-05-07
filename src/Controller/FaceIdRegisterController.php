<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Security\Core\Security;

class FaceIdRegisterController extends AbstractController
{
    #[Route('/face-id/enregistrer', name: 'app_face_id_register')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function register(
        HttpClientInterface $client,
        EntityManagerInterface $em,
        Security $security
    ): Response {
        try {
            // Appel de l'API Python
            $response = $client->request('GET', 'http://127.0.0.1:5000/generate-embedding');
            $data = $response->toArray();

            if ($data['status'] === 'success') {
                $embedding = $data['embedding'];

                // 🔐 Récupérer l'utilisateur connecté
                $user = $security->getUser();
                $user->setVisage_hash($embedding); // ✅ méthode personnalisée
                $em->persist($user);
                $em->flush();

                $this->addFlash('success', 'Visage enregistré avec succès !');
            } else {
                $this->addFlash('error', 'Aucun visage détecté. Réessayez.');
            }
        } catch (\Exception $e) {
            $this->addFlash('error', 'Erreur lors de l’enregistrement du visage : ' . $e->getMessage());
        }

        return $this->redirectToRoute('app_profile_edit'); // ou autre page
    }
}
