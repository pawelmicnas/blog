<?php declare(strict_types=1);

namespace Blog\Domain\Entity;

use Blog\Domain\Article\ArticleInterface;
use Blog\Infrastructure\Persistence\Doctrine\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article implements ArticleInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: "string", length: 80, unique: false, nullable: false)]
    private string $title;

    #[ORM\Column(type: "text", unique: false, nullable: false)]
    private string $content;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private string $image;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }
}
