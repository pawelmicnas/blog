<?php declare(strict_types=1);

namespace Blog\Application\Article\Command;

use Blog\Domain\Bus\Command\CommandInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Blog\Infrastructure\Validator\Constraints as BlogAssert;

class NewArticleCommand implements CommandInterface
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 10, max: 80)]
    public readonly string $title;

    #[Assert\NotBlank]
    #[Assert\Length(min: 20)]
    #[BlogAssert\ContainsForbiddenHTMLTags]
    public readonly string $content;

    #[Assert\File(
        maxSize: "1M",
        mimeTypes: ["image/jpeg", "image/jpg"]
    )]
    public readonly File $image;

    public function __construct(
        string $title,
        string $content,
        File $image
    ){
        $this->content = $content;
        $this->title = $title;
        $this->image = $image;
    }
}