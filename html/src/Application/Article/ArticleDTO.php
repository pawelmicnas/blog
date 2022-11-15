<?php declare(strict_types=1);

namespace Blog\Application\Article;

use Blog\Domain\Bus\DTOInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Blog\Infrastructure\Validator\Constraints as BlogAssert;

class ArticleDTO implements DTOInterface
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 10, max: 80)]
    #[BlogAssert\ContainsForbiddenHTMLTags]
    public string $title;

    #[Assert\NotBlank]
    #[Assert\Length(min: 20)]
    #[BlogAssert\ContainsForbiddenHTMLTags]
    public string $content;

    #[Assert\File(
        maxSize: "1M",
        mimeTypes: ["image/jpeg", "image/jpg"]
    )]
    public File $image;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getImage(): File
    {
        return $this->image;
    }
}