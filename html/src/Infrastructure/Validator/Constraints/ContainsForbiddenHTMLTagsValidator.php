<?php declare(strict_types=1);

namespace Blog\Infrastructure\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class ContainsForbiddenHTMLTagsValidator extends ConstraintValidator
{
    private const ALLOWED_TAGS = ['p', 'ul', 'li', 'ol', 'strong'];
    private const TAG_PATTERN_FORBIDDEN = '/<[^>]*>/';
    private const TAG_PATTERN_ALLOWED = '<%s[^>]*>|<\/%s[^>]*>';

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof ContainsForbiddenHTMLTags) {
            throw new UnexpectedTypeException($constraint, ContainsForbiddenHTMLTags::class);
        }
        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }

        $matchedForbiddenTags = $this->matchForbiddenTags($value);
        if (null !== $matchedForbiddenTags) {
            $string = implode(',', $matchedForbiddenTags);
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ tag }}', $string)
                ->addViolation();
        }
    }

    private function matchForbiddenTags(string $value): ?array
    {
        $violations = [];
        $allowedTagsRegex = $this->getAllowedTagsRegularExpression();
        if (preg_match_all(self::TAG_PATTERN_FORBIDDEN, $value, $matches)) {
            foreach (current($matches) as $match) {
                if (!preg_match($allowedTagsRegex, $match)) {
                    $violations[] = $match;
                }
            }
        }

        return empty($violations) ? null : $violations;
    }

    private function getAllowedTagsRegularExpression(): string
    {
        $regex = '';
        foreach (self::ALLOWED_TAGS as $tag) {
            $regex .= sprintf(self::TAG_PATTERN_ALLOWED, $tag, $tag) . '|';
        }

        return '/' . trim($regex, '|') . '/';
    }
}