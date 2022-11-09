<?php declare(strict_types=1);

namespace Blog\Domain\Bus\Query;

use Blog\Domain\Bus\DTOInterface;

interface ResponseInterface
{
    public function execute(): DTOInterface;
}