<?php declare(strict_types=1);

namespace Blog\Infrastructure\Persistence\Doctrine\MySQL;

use Blog\Infrastructure\Persistence\Doctrine\Connection;
use Doctrine\DBAL\Exception;

class Count
{
    public function __construct(private readonly Connection $connection)
    {}

    /**
     * @throws Exception
     */
    public function execute(string $table): int
    {
        return $this->connection->getConnection()->executeQuery("SELECT * FROM {$table}")->rowCount();
    }
}