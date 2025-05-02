<?php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class NewsService
{
    private $client;
    private $apiUrl;

    public function init(HttpClientInterface $client, string $apiUrl): void
    {
        $this->client = $client;
        $this->apiUrl = $apiUrl;
    }

    public function fetchData(string $endpoint): array
    {
        $url = $this->apiUrl . $endpoint;
        $response = $this->client->request('GET', $url);
        dump($response);

        return $response->toArray(); 
    }


    public function sendData(string $endpoint, array $data): array
    {
        // This method can still be used for POST requests
        $fullUrl = $this->apiUrl . '/' . $endpoint;  // If you want to extend with new endpoints

        $response = $this->client->request('POST', $fullUrl, [
            'json' => $data,
        ]);

        return $response->toArray();
    }
}
