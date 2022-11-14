<?php declare(strict_types=1);

namespace Blog\Infrastructure\Files;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader implements FileUploaderInterface
{
    public function __construct(
        private readonly FilePathResolverInterface $filePathResolver,
        private readonly SluggerInterface $slugger
    ) {}

    public function upload(File $file): string
    {
        $originalFilename = pathinfo($file->getPathname(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
        $file->move($this->filePathResolver->getDirectory(), $fileName);

        return $fileName;
    }

    public function getTargetDirectory(): string
    {
        return $this->filePathResolver->getDirectory();
    }
}