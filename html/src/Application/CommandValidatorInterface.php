<?php declare(strict_types=1);

namespace Blog\Application;

interface CommandValidatorInterface
{
    public function validate(CommandInterface $command): bool;
}