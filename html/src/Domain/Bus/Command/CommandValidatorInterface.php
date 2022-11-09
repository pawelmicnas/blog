<?php declare(strict_types=1);

namespace Blog\Domain\Bus\Command;

interface CommandValidatorInterface
{
    public function validate(CommandInterface $command): void;
}