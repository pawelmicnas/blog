<?php declare(strict_types=1);

namespace Blog\Domain\Assembler\Adapter;

use Blog\Domain\Bus\DTOInterface;

interface ArrayToDtoInterface
{
    public function adapt(array $data): DTOInterface;
}