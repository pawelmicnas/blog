<?php declare(strict_types=1);

namespace Blog\UserInterface\Web\Controller\Rest;

use Blog\Application\Article\Query\FindArticleQuery;
use Blog\Domain\Bus\Query\QueryBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetArticleController extends AbstractController
{
    #[Route('articles/{id}')]
    public function __invoke(int $id, QueryBusInterface $bus): JsonResponse
    {
        $response = $bus->ask(new FindArticleQuery($id));
        if (null === $response) {
            return new JsonResponse('Not found', Response::HTTP_NOT_FOUND);
        }

        return $this->json($response->execute());
    }
}