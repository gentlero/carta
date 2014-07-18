<?php

namespace Gentle\Tests\Carta;

use Gentle\Carta\Chapter;
use Gentle\Carta\ChapterInterface;

class ChapterTest extends TestCase
{
    /**
     * @var ChapterInterface
     */
    private $chapter;

    public function setUp()
    {
        parent::setUp();

        $this->chapter = new Chapter($this->root->url(), $this->parser);
    }

    public function testGetPagesCollection()
    {
        $this->assertEquals(3, count($this->chapter->getPages()));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testShouldConstructWithInvalidDirectory()
    {
        new Chapter('invalid/path', $this->parser);
    }
}
