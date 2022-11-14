<?php declare(strict_types=1);

namespace Blog\UserInterface\Cli;

use Blog\Application\Article\Command\NewArticleCommand;
use Blog\Domain\Bus\Command\CommandBusInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\MissingInputException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\HttpFoundation\File\File;

#[AsCommand(
    name: "blog:article:create",
    description: "Create new article in blog"
)]
class CreateNewArticleCommand extends Command
{
    private const TITLE = 'title';
    private const CONTENT_FILE = 'content-file';
    private const IMAGE_FILE = 'image-file';

    public function __construct(private readonly CommandBusInterface $bus, private readonly Filesystem $filesystem)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument(self::TITLE, InputArgument::REQUIRED);
        $this->addArgument(self::CONTENT_FILE, InputArgument::REQUIRED, 'Provide path to txt file with article content.');
        $this->addArgument(self::IMAGE_FILE, InputArgument::REQUIRED, 'Provide path to image file.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        [$title, $contentFile, $imageFile] = $this->extractArguments($input);
        $article = new SplFileInfo($contentFile, '', '');
        $image = $this->getImage($imageFile);
        $command = new NewArticleCommand($title, $article->getContents(), $image);
        $this->bus->dispatch($command);

        return 0;
    }

    private function extractArguments(InputInterface $input): array
    {
        if (empty($input->getArgument(self::TITLE)) || empty($input->getArgument(self::CONTENT_FILE))) {
            throw new MissingInputException(
                sprintf("Arguments %s, %s, %s are required and can not be empty", self::TITLE, self::CONTENT_FILE,
                    self::IMAGE_FILE)
            );
        }

        return [
            $input->getArgument(self::TITLE),
            $input->getArgument(self::CONTENT_FILE),
            $input->getArgument(self::IMAGE_FILE),
        ];
    }

    private function getImage(mixed $imageFile): File
    {
        $originalFile = new File($imageFile);
        $tmpFile = '/tmp/' . $originalFile->getBasename();
        $this->filesystem->copy($imageFile, $tmpFile);

        return new File($tmpFile);
    }
}