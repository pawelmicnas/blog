<?php declare(strict_types=1);

namespace Blog\Application\Article\ReadModel;

class ArticleDataObject implements ArticleDataObjectInterface
{
    public function __construct(
        private readonly int $id,
        private readonly string $title,
        private readonly string $content,
        private readonly ?string $imageUrl
    ) {
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

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }
}