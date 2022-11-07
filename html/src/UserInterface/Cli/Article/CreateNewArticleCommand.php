<?php declare(strict_types=1);

namespace Blog\UserInterface\Cli;

use Blog\Application\Article\Command\NewArticleCommand;
use Blog\Application\Article\Command\NewArticleCommandHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    name: "blog:article:create",
    description: "Create new article in blog"
)]
class CreateNewArticleCommand extends Command
{
    public function __construct(private readonly NewArticleCommandHandler $handler)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $command = new NewArticleCommand(
            'tytu',
            'za krótki content'
        );

        $this->handler->handle($command);

        return 0;
    }
}