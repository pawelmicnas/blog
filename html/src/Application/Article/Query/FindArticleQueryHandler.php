<?php declare(strict_types=1);

namespace Blog\Application\Article\Query;

use Blog\Application\Article\ReadModel\ArticleDataObjectFactory;
use Blog\Domain\Bus\Query\QueryHandlerInterface;
use Blog\Domain\Bus\Query\QueryInterface;
use Blog\Domain\Bus\Query\ResponseInterface;
use Blog\Infrastructure\Files\FilePathResolverInterface;
use Blog\Infrastructure\Persistence\Doctrine\MySQL\FindById;
use Doctrine\DBAL\Exception;

class FindArticleQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly ArticleDataObjectFactory $factory,
        private readonly FindById $findById,
        private readonly FilePathResolverInterface $filePathResolver,
    ) {}

    /**
     * @throws Exception
     */
    public function __invoke(FindArticleQuery|QueryInterface $query): ResponseInterface|FindArticleResponse|null
    {
        $result = $this->findById->execute($query->id, 'article');
        if ($result === null) {
            return null;
        }

        $imagePath = null;
        if (isset($result['image'])) {
            $imagePath = $this->filePathResolver->getImageUrl($result['image']);
        }

        return new FindArticleResponse(
            $this->factory->create($result['id'], $result['title'], $result['content'], $imagePath)
        );
    }
}