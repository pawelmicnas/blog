<?php declare(strict_types=1);

namespace Blog\UserInterface\Web\Controller\Rest;

use Blog\Application\Article\Query\FindAllArticlesQuery;
use Blog\Domain\Bus\Query\QueryBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetArticlesController extends AbstractController
{
    #[Route('articles', methods: 'GET')]
    public function __invoke(Request $request, QueryBusInterface $bus): JsonResponse
    {
        [$page, $limit] = [
            (int)$request->query->get('page', 1),
            (int)$request->query->get('limit', 5)
        ];

        $query = new FindAllArticlesQuery($page, $limit);
        $response = $bus->ask($query);
        if (null === $response) {
            return new JsonResponse('Not found', Response::HTTP_NOT_FOUND);
        }

        return $this->json($response->execute());
    }
}