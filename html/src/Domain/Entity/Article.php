<?php declare(strict_types=1);

namespace Blog\Entity\Domain;

use Blog\Domain\Article\ArticleInterface;
use Blog\Repository\Infrastructure\Persistence\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article implements ArticleInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: "string", length: 80, unique: false, nullable: false)]
    private string $title;

    #[ORM\Column(type: "text", unique: false, nullable: false)]
    private string $content;

    public function __construct(string $title, string $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
