<?php declare(strict_types=1);

namespace Blog\Infrastructure\Files;

interface FilePathResolverInterface
{
    public function getDirectory(): string;
    public function getImagePath(string $filename): string;
}