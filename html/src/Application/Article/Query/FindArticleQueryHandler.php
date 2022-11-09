<?php declare(strict_types=1);

namespace Blog\Application\Article\Query;

use Blog\Domain\Assembler\Adapter\ArrayToDtoInterface;
use Blog\Domain\Bus\Query\QueryHandlerInterface;
use Blog\Domain\Bus\Query\QueryInterface;
use Blog\Domain\Bus\Query\ResponseInterface;
use Blog\Infrastructure\Persistence\Doctrine\Connection;
use Doctrine\DBAL\Exception;

class FindArticleQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly Connection $connection,
        private readonly ArrayToDtoInterface $arrayToDto
    ) {}

    /**
     * @throws Exception
     */
    public function __invoke(QueryInterface $query): ResponseInterface|FindArticleResponse|null
    {
        $connection = $this->connection->getConnection();
        $sql = "SELECT id, title, content, image FROM article WHERE id = {$query->id};";
        $result = $connection->executeQuery($sql)->fetchAssociative();
        if (false === $result) {
            return null;
        }

        return new FindArticleResponse(
            $this->arrayToDto->adapt($result)
        );
    }
}