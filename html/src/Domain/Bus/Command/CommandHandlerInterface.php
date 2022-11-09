<?php declare(strict_types=1);

namespace Blog\Domain\Bus\Command;

interface CommandHandlerInterface
{
    public function __invoke(CommandInterface $command): void;
}