<?php declare(strict_types=1);

namespace Blog\Infrastructure\Request\RequestValidator;

use Blog\Domain\Bus\DTOInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestDTOValidator
{
    public function __construct(private readonly ValidatorInterface $validator)
    {}

    public function validate(DTOInterface $dto): ?array
    {
        $violationList = $this->validator->validate($dto);
        if ($violationList->count() === 0) {
            return null;
        }

        $messages = [];
        foreach ($violationList as $violation) {
            $messages[] = ['field' => $violation->getPropertyPath(), 'message' => $violation->getMessage()];
        }

        return $messages;
    }
}