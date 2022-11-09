<?php declare(strict_types=1);

namespace Blog\Application\Article;

class ArticleDTO implements ArticleDTOInterface
{
    public function __construct(
        private readonly int $id,
        private readonly string $title,
        private readonly string $content,
        private readonly string $imagePath
    ) {}

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

    public function getImagePath(): string
    {
        return $this->imagePath;
    }
}