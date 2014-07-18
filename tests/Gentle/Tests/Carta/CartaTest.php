<?php

namespace Gentle\Tests\Carta;

use Gentle\Carta\Carta;
use Gentle\Carta\Parser\MarkdownParser;

class CartaTest extends TestCase
{
    /**
     * @var Carta
     */
    private $carta;

    public function setUp()
    {
        parent::setUp();

        $this->carta = new Carta($this->root->url(), new MarkdownParser());
    }

    public function testShouldReturnPageInterface()
    {
        $this->assertInstanceOf('\Gentle\Carta\PageInterface', $this->carta->page('file1.md'));
    }

    public function testShouldReturnChapterInterface()
    {
        $this->assertInstanceOf('\Gentle\Carta\ChapterInterface', $this->carta->chapter('.'));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidSourceDirectory()
    {
        new Carta('invalid/path');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testShouldNotOpenInvalidDirectory()
    {
        $this->carta->open('invalid/path');
    }

    public function testOpenDirectoryShouldReturnChapterInterface()
    {
        $this->assertInstanceOf('\Gentle\Carta\ChapterInterface', $this->carta->open('.'));
    }
}
