<?php declare(strict_types=1);

namespace Blog\Domain\Article;

use Blog\Entity\Domain\Article;

class ArticleFactory
{
    public function create(string $title, string $content): ArticleInterface
    {
        return new Article($title, $content);
    }
}