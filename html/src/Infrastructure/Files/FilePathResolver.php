<?php declare(strict_types=1);

namespace Blog\Infrastructure\Files;

class FilePathResolver implements FilePathResolverInterface
{
    public function __construct(private readonly string $directory, private readonly string $domain)
    {}

    public function getDirectory(): string
    {
        return $this->directory;
    }

    public function getImagePath(string $filename): string
    {
        return $this->getDirectory() . DIRECTORY_SEPARATOR . $filename;
    }

    public function getImageUrl(string $filename): string
    {
        return rtrim($this->domain, '/') . DIRECTORY_SEPARATOR . $filename;
    }
}