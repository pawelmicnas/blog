<?php declare(strict_types=1);

namespace Blog\Application\Article\Exception;

use Blog\Domain\Article\ArticleDomainExceptionInterface;
use Exception;

class ArticleConversionException extends Exception implements ArticleDomainExceptionInterface
{
}