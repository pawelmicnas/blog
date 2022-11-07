<?php declare(strict_types=1);

namespace Blog\Domain\Article;

use Blog\Domain\Article\ArticleInterface;

interface ArticleRepositoryInterface
{
    public function save(ArticleInterface $entity): void;
    public function remove(ArticleInterface $entity): void;
}