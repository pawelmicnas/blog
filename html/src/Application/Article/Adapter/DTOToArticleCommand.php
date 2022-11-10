<?php declare(strict_types=1);

namespace Blog\Application\Article\Adapter;

use Blog\Application\Article\ArticleDTO;
use Blog\Application\Article\Command\NewArticleCommand;
use Blog\Domain\Assembler\Adapter\DTOToCommandInterface;
use Blog\Domain\Bus\Command\CommandInterface;
use Blog\Domain\Bus\DTOInterface;

class DTOToArticleCommand implements DTOToCommandInterface
{
    public function adapt(DTOInterface|ArticleDTO $dto): CommandInterface|NewArticleCommand
    {
        return new NewArticleCommand(
            $dto->getTitle(),
            $dto->getContent(),
            $dto->getImage()
        );
    }
}