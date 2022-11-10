<?php declare(strict_types=1);

namespace Blog\Application\Article;

use Symfony\Component\HttpFoundation\File\File;

class ArticleDTO implements ArticleDTOInterface
{
    public function __construct(
        private ?int $id = null,
        private ?string $title = null,
        private ?string $content = null,
        private ?File $image = null
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getImage(): ?File
    {
        return $this->image;
    }

    public function setImage(?File $image): void
    {
        $this->image = $image;
    }
}