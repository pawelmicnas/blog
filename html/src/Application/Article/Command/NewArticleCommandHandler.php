<?php declare(strict_types=1);

namespace Blog\Application\Article\Command;

use Blog\Application\Article\Exception\NewArticleValidationException;
use Blog\Domain\Article\ArticleFactory;
use Blog\Domain\Article\ArticleRepositoryInterface;
use Blog\Domain\Bus\Command\CommandHandlerInterface;
use Blog\Domain\Bus\Command\CommandInterface;

class NewArticleCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly ArticleFactory $articleFactory,
        private readonly ArticleRepositoryInterface $articleRepository,
        private readonly NewArticleCommandValidator $validator,
    ) {}

    /**
     * @throws NewArticleValidationException
     */
    public function __invoke(NewArticleCommand|CommandInterface $command): void
    {
        $this->validator->validate($command);
        $article = $this->articleFactory->create()
            ->setTitle($command->title)
            ->setContent($command->content)
            ->setImage('test.jpg');

        $this->articleRepository->save($article);
    }
}