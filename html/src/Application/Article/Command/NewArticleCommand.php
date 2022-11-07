<?php declare(strict_types=1);

namespace Blog\Application\Article\Command;

use Blog\Application\CommandInterface;
use Symfony\Component\Validator\Constraints as Assert;

class NewArticleCommand implements CommandInterface
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 10, max: 80)]
    public readonly string $title;

    #[Assert\NotBlank]
    #[Assert\Length(min: 20)]
    public readonly string $content;

    public function __construct(
        string $title,
        string $content,
    ){
        $this->content = $content;
        $this->title = $title;
    }
}