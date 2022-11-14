<?php declare(strict_types=1);

namespace Blog\Application\Article\Query;

use Blog\Domain\Bus\Query\QueryInterface;

class FindAllArticlesQuery implements QueryInterface
{
    public function __construct(public readonly int $page = 1, public readonly int $limit = 5)
    {}
}