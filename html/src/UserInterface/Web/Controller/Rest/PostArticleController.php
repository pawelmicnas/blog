<?php declare(strict_types=1);

namespace Blog\UserInterface\Web\Controller\Rest;

use Blog\Application\Article\Adapter\DTOToArticleCommand;
use Blog\Application\Article\ArticleDTO;
use Blog\Domain\Bus\Command\CommandBusInterface;
use Blog\Infrastructure\Request\RequestValidator\RequestDTOValidator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostArticleController extends AbstractController
{
    #[Route('articles', methods: ['POST'])]
    #[ParamConverter('DTO', class: ArticleDTO::class)]
    public function __invoke(
        ArticleDTO $articleDto,
        CommandBusInterface $bus,
        DTOToArticleCommand $adapter,
        RequestDTOValidator $validator,
    ): JsonResponse {
        $violations = $validator->validate($articleDto);
        if (!empty($violations)) {
            return $this->json($violations, Response::HTTP_BAD_REQUEST);
        }
        $bus->dispatch($adapter->adapt($articleDto));

        return $this->json('New article request successfully created.', Response::HTTP_CREATED);
    }
}