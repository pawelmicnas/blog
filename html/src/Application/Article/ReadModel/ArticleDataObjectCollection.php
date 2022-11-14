<?php declare(strict_types=1);

namespace Blog\Application\Article\ReadModel;

class ArticleDataObjectCollection implements ArticleDataObjectCollectionInterface
{
    /** @var ArticleDataObjectInterface[] */
    private readonly array $articles;

    public function __construct(private readonly int $count, ArticleDataObjectInterface ...$articles)
    {
        $this->articles = $articles;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function getArticles(): array
    {
        return $this->articles;
    }
}