<?php declare(strict_types=1);

namespace Blog\Application\Article\ReadModel;

class ArticleDataObjectFactory
{
    public function create(int $id, string $title, string $content, ?string $imageUrl): ArticleDataObjectInterface
    {
        return new ArticleDataObject($id, $title, $content, $imageUrl);
    }
}