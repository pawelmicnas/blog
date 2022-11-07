<?php declare(strict_types=1);

namespace Blog\Application\Article\Command;

use Blog\Application\Article\Exception\NewArticleValidationException;
use Blog\Application\CommandInterface;
use Blog\Application\CommandValidatorInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class NewArticleCommandValidator implements CommandValidatorInterface
{
    public function __construct(private readonly ValidatorInterface $validator)
    {}

    /**
     * @throws NewArticleValidationException
     */
    public function validate(NewArticleCommand|CommandInterface $command): bool
    {
        $violations = $this->validator->validate($command);
        if (count($violations) > 0) {
            throw new NewArticleValidationException((string)($violations));
        }

        return true;
    }
}