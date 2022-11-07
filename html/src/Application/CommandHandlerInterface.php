<?php declare(strict_types=1);

namespace Blog\Application;

interface CommandHandlerInterface
{
    public function handle(CommandInterface $command): void;
}