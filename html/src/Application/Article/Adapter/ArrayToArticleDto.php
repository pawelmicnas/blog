<?php declare(strict_types=1);

namespace Blog\Application\Article\Adapter;

use Blog\Application\Article\ArticleDTO;
use Blog\Application\Article\ArticleDTOInterface;
use Blog\Application\Article\Exception\ArticleConversionException;
use Blog\Domain\Assembler\Adapter\ArrayToDtoInterface;
use Blog\Domain\Bus\DTOInterface;

class ArrayToArticleDto implements ArrayToDtoInterface
{
    /**
     * @throws ArticleConversionException
     */
    public function adapt(array $data): DTOInterface|ArticleDTOInterface
    {
        $this->validate($data);

        return new ArticleDTO(
            $data['id'],
            $data['title'],
            $data['content'],
            $data['image']
        );
    }

    /**
     * @throws ArticleConversionException
     */
    private function validate(array $data): void
    {
        if (!isset($data['id']) || !isset($data['title']) || !isset($data['content']) || !isset($data['image'])) {
            throw new ArticleConversionException();
        }
    }
}