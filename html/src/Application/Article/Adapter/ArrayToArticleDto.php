<?php declare(strict_types=1);

namespace Blog\Application\Article\Adapter;

use Blog\Application\Article\ArticleDTO;
use Blog\Domain\Assembler\Adapter\ArrayToDtoInterface;
use Blog\Domain\Bus\DTOInterface;

class ArrayToArticleDto implements ArrayToDtoInterface
{
    public function adapt(array $data): DTOInterface
    {
        return new ArticleDTO(
            $data['id'],
            $data['title'],
            $data['content'],
            $data['image']
        );
    }
}