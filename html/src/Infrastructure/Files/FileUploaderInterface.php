<?php declare(strict_types=1);

namespace Blog\Infrastructure\Files;

use Symfony\Component\HttpFoundation\File\File;

interface FileUploaderInterface
{
    public function upload(File $file): string;
    public function getTargetDirectory(): string;
}