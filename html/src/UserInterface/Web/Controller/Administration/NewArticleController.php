<?php declare(strict_types=1);

namespace Blog\UserInterface\Web\Controller\Administration;

use Blog\Domain\Article\ArticleFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewArticleController extends AbstractController
{
    public function __construct(private readonly ArticleFactory $articleFactory)
    {}

    #[Route('article/new')]
    public function __invoke(): Response
    {
        $article = $this->articleFactory->create();
        $form = $this->createFormBuilder($article);
    }
}