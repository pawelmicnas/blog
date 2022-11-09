<?php declare(strict_types=1);

namespace Blog\Domain\Bus\Query;

interface QueryHandlerInterface
{
    public function __invoke(QueryInterface $query): ResponseInterface|null;
}