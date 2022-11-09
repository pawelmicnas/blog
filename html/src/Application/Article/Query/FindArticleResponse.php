<?php declare(strict_types=1);

namespace Blog\Application\Article\Query;

use Blog\Application\Article\ArticleDTOInterface;
use Blog\Domain\Bus\DTOInterface;
use Blog\Domain\Bus\Query\ResponseInterface;

class FindArticleResponse implements ResponseInterface
{
    public function __construct(private readonly ArticleDTOInterface $articleDTO){}

    public function execute(): DTOInterface
    {
        return $this->articleDTO;
    }
}