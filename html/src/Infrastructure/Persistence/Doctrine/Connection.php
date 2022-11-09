<?php declare(strict_types=1);

namespace Blog\Infrastructure\Persistence\Doctrine;

use Doctrine\DBAL\Connection as DoctrineConnection;
use Doctrine\ORM\EntityManagerInterface;

class Connection
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {}

    public function getConnection(): DoctrineConnection
    {
        return $this->entityManager->getConnection();
    }
}