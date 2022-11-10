<?php declare(strict_types=1);

namespace Blog\Tests\Application\Article\Command;

use Blog\Application\Article\Command\NewArticleCommandValidator;
use Blog\Application\Article\Exception\NewArticleValidationException;
use Blog\Domain\Bus\Command\CommandInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class NewArticleCommandValidatorTest extends KernelTestCase
{
    private NewArticleCommandValidator $subject;
    private ValidatorInterface|MockObject $validatorMock;
    private MockObject|CommandInterface $commandMock;
    private MockObject|ConstraintViolationListInterface $violationsMock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->validatorMock = $this->getMockForAbstractClass(ValidatorInterface::class);
        $this->commandMock = $this->getMockForAbstractClass(CommandInterface::class);
        $this->violationsMock = $this->getMockBuilder(ConstraintViolationListInterface::class)
            ->addMethods(['__toString'])
            ->getMockForAbstractClass();
        $this->subject = new NewArticleCommandValidator($this->validatorMock);
    }

    public function testGivenCorrectCommand_thenAssertExceptionIsNotThrown(): void
    {
        $this->violationsMock->method('count')->willReturn(0);
        $this->validatorMock->method('validate')->willReturn($this->violationsMock);
        $this->expectNotToPerformAssertions();
        $this->subject->validate($this->commandMock);
    }

    public function testGivenInvalidCommand_thenAssertExceptionIsThrown(): void
    {
        $this->violationsMock->method('count')->willReturn(1);
        $this->violationsMock->method('__toString')->willReturn('Error');
        $this->validatorMock->method('validate')->willReturn($this->violationsMock);
        $this->expectException(NewArticleValidationException::class);
        $this->subject->validate($this->commandMock);
    }
}