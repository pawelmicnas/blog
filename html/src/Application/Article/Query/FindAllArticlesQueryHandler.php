<?php declare(strict_types=1);

namespace Blog\Application\Article\Query;

use Blog\Application\Article\ReadModel\ArticleDataObjectCollection;
use Blog\Application\Article\ReadModel\ArticleDataObjectFactory;
use Blog\Domain\Bus\Query\QueryHandlerInterface;
use Blog\Domain\Bus\Query\QueryInterface;
use Blog\Domain\Bus\Query\ResponseInterface;
use Blog\Infrastructure\Files\FilePathResolverInterface;
use Blog\Infrastructure\Persistence\Doctrine\MySQL\Count;
use Blog\Infrastructure\Persistence\Doctrine\MySQL\FindAllByPage;
use Doctrine\DBAL\Exception;

class FindAllArticlesQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly FindAllByPage $findAllByPage,
        private readonly FilePathResolverInterface $filePathResolver,
        private readonly ArticleDataObjectFactory $factory,
        private readonly Count $count
    ) {}

    /**
     * @throws Exception
     */
    public function __invoke(FindAllArticlesQuery|QueryInterface $query): ResponseInterface|null
    {
        $result = $this->findAllByPage->execute('article', $query->page, $query->limit);
        if (empty($result)) {
            return null;
        }

        $count = $this->count->execute('article');
        $articles = [];
        foreach ($result as $articleData) {
            $imagePath = null;
            if (isset($articleData['image'])) {
                $imagePath = $this->filePathResolver->getImageUrl($articleData['image']);
            }
            $articles[] = $this->factory->create($articleData['id'], $articleData['title'], $articleData['content'], $imagePath);
        }

        return new FindAllArticlesResponse(new ArticleDataObjectCollection($count, ...$articles));
    }
}