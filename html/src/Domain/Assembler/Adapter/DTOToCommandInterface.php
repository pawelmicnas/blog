<?php declare(strict_types=1);

namespace Blog\Domain\Assembler\Adapter;

use Blog\Domain\Bus\Command\CommandInterface;
use Blog\Domain\Bus\DTOInterface;

interface DTOToCommandInterface
{
    public function adapt(DTOInterface $dto): CommandInterface;
}