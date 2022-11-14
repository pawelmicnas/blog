<?php declare(strict_types=1);

namespace Blog\UserInterface\Web\Controller\Rest;

use Blog\Application\Article\Command\NewArticleCommand;
use Blog\Domain\Bus\Command\CommandBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostArticleController extends AbstractController
{
    #[Route('articles', methods: ['POST'])]
    public function __invoke(Request $request, CommandBusInterface $bus): JsonResponse
    {
        $title = $request->get('title');
        $content = $request->get('content');
        $image = $request->files->get('image');
        $bus->dispatch(new NewArticleCommand($title, $content, $image));

        return $this->json('New article request successfully created.', Response::HTTP_CREATED);
    }
}