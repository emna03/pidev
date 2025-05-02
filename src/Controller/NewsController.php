<?php
// src/Controller/NewsController.php
namespace App\Controller;

use App\Service\NewsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class NewsController extends AbstractController
{
    #[Route('/news', name: 'news_index')]
    public function index(HttpClientInterface $httpClient,SessionInterface $session): Response
{
    // Instantiate NewsService and call init()
    $newsService = new NewsService();
    $newsService->init(
        $httpClient,
        $_ENV['NEWS_API_URL']
    );

    $data = $newsService->fetchData(''); 

    if (isset($data['status']) && $data['status'] === 'success') {
        $articles = $data['results'];
        $session->set('news_articles', $articles);

    } else {
        $articles = [];
    }

    return $this->render('news/list.html.twig', [
        'news' => $articles, 
    ]);
}


#[Route('/news/{id}', name: 'news_detail')]
public function detail(string $id, SessionInterface $session): Response
{
    $articles = $session->get('news_articles', []);
    $selectedArticle = null;

    foreach ($articles as $article) {
        if ($article['article_id'] === $id) {
            $selectedArticle = $article;
            break;
        }
    }

    if (!$selectedArticle) {
        throw $this->createNotFoundException("Article not found.");
    }

    return $this->render('news/detail.html.twig', [
        'news' => $selectedArticle,
    ]);
}
}
