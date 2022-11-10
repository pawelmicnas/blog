<?php declare(strict_types=1);

namespace Blog\Infrastructure\Validator\Constraints;

use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute]
class ContainsForbiddenHTMLTags extends Constraint
{
    public string $message = 'Text contain forbidden HTML tag: "{{ tag }}"';
}