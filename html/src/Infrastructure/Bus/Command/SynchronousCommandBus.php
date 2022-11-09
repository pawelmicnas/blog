<?php declare(strict_types=1);

namespace Blog\Infrastructure\Bus\Command;

use Blog\Domain\Bus\Command\CommandBusInterface;
use Blog\Domain\Bus\Command\CommandInterface;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;

class SynchronousCommandBus implements CommandBusInterface
{
    private MessageBus $bus;

    public function __construct(array $handlers)
    {
        $this->bus = new MessageBus([
            new HandleMessageMiddleware(new HandlersLocator($handlers)),
        ]);
    }

    public function dispatch(CommandInterface $command): void
    {
        $this->bus->dispatch($command);
    }
}