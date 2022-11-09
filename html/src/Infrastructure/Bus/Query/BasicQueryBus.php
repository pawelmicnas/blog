<?php declare(strict_types=1);

namespace Blog\Infrastructure\Bus\Query;

use Blog\Domain\Bus\Query\QueryBusInterface;
use Blog\Domain\Bus\Query\QueryInterface;
use Blog\Domain\Bus\Query\ResponseInterface;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class BasicQueryBus implements QueryBusInterface
{
    private MessageBus $bus;

    public function __construct(array $handlers)
    {
        $this->bus = new MessageBus([
            new HandleMessageMiddleware(new HandlersLocator($handlers)),
        ]);
    }

    public function ask(QueryInterface $query): ?ResponseInterface
    {
        $handledStamp = $this->bus->dispatch($query)->last(HandledStamp::class);

        return $handledStamp->getResult();
    }
}