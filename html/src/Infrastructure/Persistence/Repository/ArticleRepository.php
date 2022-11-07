<?php declare(strict_types=1);

namespace Blog\Repository\Infrastructure\Persistence;

use Blog\Domain\Article\ArticleInterface;
use Blog\Domain\Article\ArticleRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class ArticleRepository implements ArticleRepositoryInterface
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {}

    public function save(ArticleInterface $entity): void
    {
        $this->entityManager->persist($entity);
    }

    public function remove(ArticleInterface $entity): void
    {
        $this->entityManager->remove($entity);
    }
}
