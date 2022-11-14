<?php declare(strict_types=1);

namespace Blog\Application\Article\ReadModel;

use Blog\Domain\ReadModel\DataObjectInterface;

interface ArticleDataObjectInterface extends DataObjectInterface
{
    public function getId(): int;
    public function getTitle(): string;
    public function getContent(): string;
    public function getImageUrl(): ?string;
}