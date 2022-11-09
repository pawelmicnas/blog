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
    public function __construct(private readonly QueryBusInterface $bus){}

    #[Route('rest/articles/{id}')]
    public function __invoke(int $id): JsonResponse
    {
        $query = new FindArticleQuery($id);
        $response = $this->bus->ask($query);
        if (null === $response) {
            return new JsonResponse('Not found', Response::HTTP_NOT_FOUND);
        }

        $articleDto = $response->execute();
        return new JsonResponse([
            'id' => $articleDto->getId(),
            'title' => $articleDto->getTitle(),
            'content' => $articleDto->getContent(),
            'imagePath' => $articleDto->getImagePath(),
        ]);
    }
}