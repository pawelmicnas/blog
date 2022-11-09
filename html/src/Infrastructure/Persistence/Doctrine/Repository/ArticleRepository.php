<?php declare(strict_types=1);

namespace Blog\Infrastructure\Persistence\Doctrine\Repository;

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
        $this->entityManager->flush();
    }

    public function remove(ArticleInterface $entity): void
    {
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }
}
