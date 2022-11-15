<?php declare(strict_types=1);

namespace Blog\Tests\Unit\Application\Article;

use Blog\Infrastructure\Validator\Constraints\ContainsForbiddenHTMLTags;
use Blog\Infrastructure\Validator\Constraints\ContainsForbiddenHTMLTagsValidator;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class ContainsForbiddenHTMLTagsTest extends ConstraintValidatorTestCase
{
    protected function createValidator(): ContainsForbiddenHTMLTagsValidator
    {
        return new ContainsForbiddenHTMLTagsValidator();
    }

    public function testGivenCorrectContent_thenAssertNoViolationsWereFound(): void
    {
        $this->validator->validate('<p>test</p>', new ContainsForbiddenHTMLTags());
        $this->assertNoViolation();
    }

    public function testGivenInvalidContentWithNotExistingHTMLTag_thenAssertViolationIsFound(): void
    {
        $constraint = new ContainsForbiddenHTMLTags();
        $tag = '<divvvvvvv >';
        $this->validator->validate($tag, $constraint);
        $this->buildViolation('Text contain forbidden HTML tag: "{{ tag }}"')
            ->setParameter('{{ tag }}', $tag)
            ->assertRaised();
    }
}