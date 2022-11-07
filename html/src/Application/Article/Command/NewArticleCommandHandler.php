<?php declare(strict_types=1);

namespace Blog\Application\Article\Command;

use Blog\Application\Article\Exception\NewArticleValidationException;
use Blog\Application\CommandHandlerInterface;
use Blog\Application\CommandInterface;

class NewArticleCommandHandler implements CommandHandlerInterface
{
    public function __construct(private readonly NewArticleCommandValidator $validator)
    {}

    /**
     * @throws NewArticleValidationException
     */
    public function handle(NewArticleCommand|CommandInterface $command): void
    {
        $this->validator->validate($command);

    }
}