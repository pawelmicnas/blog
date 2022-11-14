<?php declare(strict_types=1);

namespace Blog\Application\Article\Query;

use Blog\Application\Article\ReadModel\ArticleDataObjectCollectionInterface;
use Blog\Domain\Bus\Query\ResponseInterface;
use Blog\Domain\ReadModel\DataObjectInterface;

class FindAllArticlesResponse implements ResponseInterface
{
    public function __construct(private readonly ArticleDataObjectCollectionInterface $collection)
    {}

    public function execute(): ArticleDataObjectCollectionInterface|DataObjectInterface
    {
        return $this->collection;
    }
}