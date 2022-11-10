<?php declare(strict_types=1);

namespace Blog\UserInterface\Web\Controller\Administration;

use Blog\Application\Article\ArticleDTO;
use Blog\Domain\Assembler\Adapter\DTOToCommandInterface;
use Blog\Domain\Bus\Command\CommandBusInterface;
use Blog\Infrastructure\Form\Article\ArticleFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewArticleController extends AbstractController
{
    public function __construct(
        private readonly CommandBusInterface $bus,
        private readonly DTOToCommandInterface $adapter
    ) {}

    #[Route('article/new', name: 'article_new')]
    public function __invoke(Request $request): Response
    {
        $article = new ArticleDTO();
        $form = $this->createForm(ArticleFormType::class, $article);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $dto = $form->getData();
            $command = $this->adapter->adapt($dto);
            $this->bus->dispatch($command);

            return $this->redirectToRoute('article_success');
        }

        return $this->renderForm(
            'administration/article/new.html.twig', [
                'form' => $form
            ]
        );
    }
}