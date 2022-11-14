<?php declare(strict_types=1);

namespace Blog\UserInterface\Web\Controller\Rest;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostArticleController extends AbstractController
{
    #[Route('articles', methods: ['POST'])]
    public function __invoke(): JsonResponse
    {
        return $this->json('New article request successfully created.', Response::HTTP_CREATED);
    }
}