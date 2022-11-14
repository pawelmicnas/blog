<?php declare(strict_types=1);

namespace Blog\Infrastructure\Persistence\Doctrine\MySQL;

use Blog\Infrastructure\Persistence\Doctrine\Connection;
use Doctrine\DBAL\Exception;

class FindById
{
    public function __construct(private readonly Connection $connection)
    {}

    /**
     * @throws Exception
     */
    public function execute(mixed $identifier, string $table): ?array
    {
        $sql = "SELECT * FROM {$table} WHERE id = {$identifier};";
        $result = $this->connection->getConnection()->executeQuery($sql)->fetchAssociative();

        return false === $result ? null : $result;
    }
}