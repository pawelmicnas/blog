<?php declare(strict_types=1);

namespace Blog\Domain\Article;

interface ArticleInterface
{
    public function getId(): int;
    public function getTitle(): string;
    public function getContent(): string;
    public function setTitle(string $title): self;
    public function setContent(string $content): self;
    public function setImage(string $image): self;
}