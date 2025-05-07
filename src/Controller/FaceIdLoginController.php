<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Security\LoginFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class FaceIdLoginController extends AbstractController
{
    private const FACE_MATCH_THRESHOLD = 0.35; // ✅ Cosine distance seuil

    #[Route('/login-face-id', name: 'app_login_face_id')]
    public function loginWithFaceId(
        HttpClientInterface $client,
        EntityManagerInterface $em,
        UserAuthenticatorInterface $authenticatorManager,
        LoginFormAuthenticator $authenticator,
        RequestStack $requestStack
    ): Response {
        try {
            $host = '127.0.0.1';
$port = 5000;

// Test si Flask tourne
$connection = @fsockopen($host, $port);
if (!$connection) {
    $projectDir = $this->getParameter('kernel.project_dir');
    $scriptDir = $projectDir . '\python-face-api';
    $command = "cd /D \"$scriptDir\" && start /MIN cmd /c python app.py";

    // Lancer le processus
    pclose(popen("start /B cmd /c \"$command\"", "r"));

    sleep(4); // Attendre que Flask démarre
} else {
    fclose($connection);
}
            $response = $client->request('GET', 'http://127.0.0.1:5000/generate-embedding');

if ($response->getStatusCode() !== 200) {
    $this->addFlash('error', '❌ Aucun visage détecté. Veuillez bien positionner votre visage devant la caméra.');
    return $this->redirectToRoute('app_login');
}

$data = $response->toArray();


            if ($data['status'] !== 'success') {
                $this->addFlash('error', '❌ Aucun visage détecté. Essayez encore.');
                return $this->redirectToRoute('app_login');
            }

            $capturedEmbedding = explode(' ', $data['embedding']);
            $utilisateurs = $em->getRepository(Utilisateur::class)->findAll();

            if (!$utilisateurs) {
                $this->addFlash('error', '⚠️ Aucun utilisateur trouvé dans la base de données.');
                return $this->redirectToRoute('app_login');
            }

            $utilisateurTrouve = null;
            $distanceMin = PHP_FLOAT_MAX;

            foreach ($utilisateurs as $user) {
                if (!$user->getVisage_hash()) continue;

                $storedEmbedding = explode(' ', $user->getVisage_hash());
                if (count($storedEmbedding) !== count($capturedEmbedding)) continue;

                $distance = $this->calculateCosineDistance($capturedEmbedding, $storedEmbedding);

                if ($distance < self::FACE_MATCH_THRESHOLD && $distance < $distanceMin) {
                    $utilisateurTrouve = $user;
                    $distanceMin = $distance;
                }
            }

            if ($utilisateurTrouve) {
                $this->addFlash('success', '🎉 Bienvenue ' . $utilisateurTrouve->getPrenom() . ', connexion réussie avec Face ID.');
                return $authenticatorManager->authenticateUser(
                    $utilisateurTrouve,
                    $authenticator,
                    $requestStack->getCurrentRequest()
                );
            }

            $this->addFlash('error', '⚠️ Visage détecté, mais aucun utilisateur correspondant trouvé avec un seuil fiable. Veuillez enregistrer votre visage dans votre profil.');
            return $this->redirectToRoute('app_login');

        } catch (\Exception $e) {
            $this->addFlash('error', '❌ Erreur Face ID : ' . $e->getMessage());
            return $this->redirectToRoute('app_login');
        }
    }

    private function calculateCosineDistance(array $e1, array $e2): float
    {
        $dot = 0.0;
        $normA = 0.0;
        $normB = 0.0;

        for ($i = 0; $i < count($e1); $i++) {
            $a = (float)$e1[$i];
            $b = (float)$e2[$i];

            $dot += $a * $b;
            $normA += $a * $a;
            $normB += $b * $b;
        }

        if ($normA == 0 || $normB == 0) return 1.0; // Sécurité

        return 1.0 - ($dot / (sqrt($normA) * sqrt($normB))); // 0 = parfait, proche de 1 = différent
    }
}
