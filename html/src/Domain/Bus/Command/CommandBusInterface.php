<?php declare(strict_types=1);

namespace Blog\Domain\Bus\Command;

interface CommandBusInterface
{
    public function dispatch(CommandInterface $command): void;
}