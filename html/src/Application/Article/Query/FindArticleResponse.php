<?php declare(strict_types=1);

namespace Blog\Application\Article\Query;

use Blog\Application\Article\ReadModel\ArticleDataObjectInterface;
use Blog\Domain\Bus\Query\ResponseInterface;
use Blog\Domain\ReadModel\DataObjectInterface;

class FindArticleResponse implements ResponseInterface
{
    public function __construct(private readonly ArticleDataObjectInterface $article){}

    public function execute(): DataObjectInterface
    {
        return $this->article;
    }
}