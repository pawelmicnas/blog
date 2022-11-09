<?php declare(strict_types=1);

namespace Blog\Application\Article;

use Blog\Domain\Bus\DTOInterface;

interface ArticleDTOInterface extends DTOInterface
{
    public function getId(): int;
    public function getTitle(): string;
    public function getContent(): string;
    public function getImagePath(): string;
}