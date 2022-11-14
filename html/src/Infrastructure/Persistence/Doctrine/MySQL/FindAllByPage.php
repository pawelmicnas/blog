<?php declare(strict_types=1);

namespace Blog\Infrastructure\Persistence\Doctrine\MySQL;

use Blog\Infrastructure\Persistence\Doctrine\Connection;
use Doctrine\DBAL\Exception;

class FindAllByPage
{
    public function __construct(private readonly Connection $connection)
    {}

    /**
     * @throws Exception
     */
    public function execute(string $table, int $page, int $limit): ?array
    {
        $offset = ($page-1) * $limit;
        $connection = $this->connection->getConnection();
        $sql = "SELECT * FROM {$table} LIMIT {$limit} OFFSET {$offset}";
        $result = $connection->executeQuery($sql)->fetchAllAssociative();

        return !empty($result) ? $result : null;
    }
}