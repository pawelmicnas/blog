<?php declare(strict_types=1);

namespace Blog\Domain\Article;

use Blog\Domain\Entity\Article;

class ArticleFactory
{
    public function create(): ArticleInterface
    {
        return new Article();
    }
}