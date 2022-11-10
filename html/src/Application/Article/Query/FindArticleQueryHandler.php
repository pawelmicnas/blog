<?php declare(strict_types=1);

namespace Blog\Application\Article\Query;

use Blog\Domain\Assembler\Adapter\ArrayToDtoInterface;
use Blog\Domain\Bus\Query\QueryHandlerInterface;
use Blog\Domain\Bus\Query\QueryInterface;
use Blog\Domain\Bus\Query\ResponseInterface;
use Blog\Infrastructure\Files\FilePathResolverInterface;
use Blog\Infrastructure\Persistence\Doctrine\Connection;
use Doctrine\DBAL\Exception;
use Symfony\Component\HttpFoundation\File\File;

class FindArticleQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly ArrayToDtoInterface $arrayToDto,
        private readonly Connection $connection,
        private readonly FilePathResolverInterface $filePathResolver,
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

        if (isset($result['image'])) {
            $imagePath = $this->filePathResolver->getImagePath($result['image']);
            $result['image'] = new File($imagePath);
        }

        return new FindArticleResponse(
            $this->arrayToDto->adapt($result)
        );
    }
}