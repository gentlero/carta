<?php

namespace Gentle\Carta;

use Gentle\Carta\Parser\MarkdownParser;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamFile;

class PageTest extends TestCase
{
    /**
     * @var PageInterface
     */
    private $page;

    public function setUp()
    {
        parent::setUp();

        $this->page = new Page($this->file1, $this->parser);
    }
    
    public function testGetHtmlContent()
    {
        $this->assertEquals('<p>file1 content</p>', trim($this->page->getContent()));
    }

    public function testGetMetaTags()
    {
        $this->assertEquals(
            array(
                'title'         => 'File 1',
                'categories'    => array('cat1', 'cat2')
            ),
            $this->page->getMetaTags()
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testShouldNotConstructWithInvalidFile()
    {
        new Page('invalid/path', $this->parser);
    }

    public function testSetAndGetSingleMetaTag()
    {
        $this->page->setMetaTag('dummy', 'value');
        $this->assertEquals('value', $this->page->getMetaTag('dummy'));
    }
}
