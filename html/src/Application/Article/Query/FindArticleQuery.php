<?php declare(strict_types=1);

namespace Blog\Application\Article\Query;

use Blog\Domain\Bus\Query\QueryInterface;

class FindArticleQuery implements QueryInterface
{
    public function __construct(public readonly int $id){}
}