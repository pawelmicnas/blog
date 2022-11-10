<?php declare(strict_types=1);

namespace Blog\Application\Article;

use Blog\Domain\Bus\DTOInterface;
use Symfony\Component\HttpFoundation\File\File;

interface ArticleDTOInterface extends DTOInterface
{
    public function getId(): ?int;
    public function getTitle(): ?string;
    public function getContent(): ?string;
    public function getImage(): ?File;
}