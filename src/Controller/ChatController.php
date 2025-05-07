<?php
// src/Controller/ChatController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
class ChatController extends AbstractController
{
    #[Route('/chat', name: 'app_chat')]
    public function index(): Response
    {
        return $this->render('chat/index.html.twig');
    }

    #[Route('/chat/send', name: 'app_chat_send', methods: ['POST'])]
    public function send(Request $request, HttpClientInterface $client): JsonResponse
    {
        $message = $request->request->get('message');
        $this->ensureOllamaIsRunning();

        if (!$message) {
            return new JsonResponse(['response' => '❌ Aucun message reçu.'], 400);
        }

        // Contexte pour restreindre le sujet
        $context = "Tu es un assistant spécialisé dans les villes intelligentes (Smart City). Réponds uniquement aux questions liées à l'énergie, la mobilité, la durabilité, les données urbaines, la gouvernance, etc. Si la question ne concerne pas ces sujets, indique gentiment que tu ne peux répondre que sur le thème des Smart Cities.";

        try {
            $response = $client->request('POST', 'http://localhost:11434/api/generate', [
                'json' => [
                    'model' => 'mistral:7b-instruct',
                    'prompt' => $context . "\n\nQuestion: " . $message,
                    'stream' => false,
                ],
                'timeout' => 180
            ]);

            $data = $response->toArray();

            return new JsonResponse([
                'response' => $data['response'] ?? '❌ Pas de réponse du modèle.',
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'response' => '❌ Erreur lors de la communication avec le modèle : ' . $e->getMessage(),
            ], 500);
        }
    }
    private function ensureOllamaIsRunning(): void
{
    $curl = curl_init("http://localhost:11434");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 2);

    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    if ($httpCode !== 200) {
        // 🟣 Start ollama serve
        $processServe = new Process(['ollama', 'serve']);
        $processServe->start(); // start() = async

        sleep(2); // Attendre qu'il démarre

        // 🟣 Start the model (mistral)
        $processModel = new Process(['ollama', 'run', 'mistral:7b-instruct']);
        $processModel->start();

        // Tu peux logger ici si tu veux.
    }
}
}
