<?php declare(strict_types=1);

namespace Blog\Tests\Unit\Infrastructure\Request\RequestValidator;

use Blog\Application\Article\ArticleDTO;
use Blog\Infrastructure\Request\RequestValidator\RequestDTOValidator;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestDTOValidatorTest extends KernelTestCase
{
    private ValidatorInterface&MockObject $validatorMock;
    private MockObject&ConstraintViolationListInterface $violationsMock;

    protected function setUp(): void
    {
        $this->validatorMock = $this->getMockBuilder(ValidatorInterface::class)
            ->onlyMethods(['validate'])
            ->getMockForAbstractClass();
        $this->violationsMock = $this->getMockBuilder(ConstraintViolationListInterface::class)
            ->getMockForAbstractClass();
        $this->subject = new RequestDTOValidator($this->validatorMock);
    }

    public function testGivenCorrectDTO_thenAssertResultIsNull(): void
    {
        $this->violationsMock->method('count')->willReturn(0);
        $this->validatorMock->method('validate')->willReturn($this->violationsMock);
        $result = $this->subject->validate(new ArticleDTO());
        $this->assertNull($result);
    }
}