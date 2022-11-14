<?php declare(strict_types=1);

namespace Blog\Domain\Bus\Query;

use Blog\Domain\ReadModel\DataObjectInterface;

interface ResponseInterface
{
    public function execute(): DataObjectInterface;
}