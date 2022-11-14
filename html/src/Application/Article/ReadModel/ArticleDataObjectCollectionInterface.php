<?php declare(strict_types=1);

namespace Blog\Application\Article\ReadModel;

use Blog\Domain\ReadModel\DataObjectInterface;

interface ArticleDataObjectCollectionInterface extends DataObjectInterface
{
    public function getCount(): int;
    public function getArticles(): array;
}