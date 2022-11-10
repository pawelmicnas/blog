<?php declare(strict_types=1);

namespace Blog\Tests\Unit\Application\Article\Adapter;

use Blog\Application\Article\Adapter\ArrayToArticleDto;
use Blog\Application\Article\Exception\ArticleConversionException;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\File\File;

class ArrayToArticleDtoTest extends KernelTestCase
{
    private File&MockObject $fileMock;
    private ArrayToArticleDto $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->fileMock = $this->createMock(File::class);
        $this->subject = new ArrayToArticleDto();
    }

    public function testGivenCorrectArray_thenAssertDtoContainCorrectData(): void
    {
        $data = [
            'id' => 1,
            'title' => 'test',
            'content' => 'content',
            'image' => $this->fileMock
        ];

        $dto = $this->subject->adapt($data);
        $this->assertEquals(1, $dto->getId());
        $this->assertEquals('test', $dto->getTitle());
        $this->assertEquals('content', $dto->getContent());
        $this->assertEquals($this->fileMock, $dto->getImage());
    }

    public function testGivenInvalidArray_thenAssertExceptionIsThrown(): void
    {
        $data = ['nothing'];
        $this->expectException(ArticleConversionException::class);
        $this->subject->adapt($data);
    }
}