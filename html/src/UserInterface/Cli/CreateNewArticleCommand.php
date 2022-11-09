<?php declare(strict_types=1);

namespace Blog\UserInterface\Cli;

use Blog\Application\Article\Command\NewArticleCommand;
use Blog\Domain\Bus\Command\CommandBusInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    name: "blog:article:create",
    description: "Create new article in blog"
)]
class CreateNewArticleCommand extends Command
{
    private const TITLE = 'title';
    const CONTENT_FILE = 'content-file';

    public function __construct(private readonly CommandBusInterface $bus)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument(self::TITLE, InputArgument::REQUIRED);
        $this->addArgument(self::CONTENT_FILE, InputArgument::REQUIRED, 'Provide path to txt file with article content.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $command = new NewArticleCommand();

        $this->bus->dispatch($command);

        return 0;
    }
}