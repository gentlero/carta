<?php

namespace Gentle\Carta;

use Gentle\Carta\Parser\MarkdownParser;
use Gentle\Carta\Parser\ParserInterface;
use org\bovigo\vfs\vfsStreamDirectory;
use PHPUnit_Framework_TestCase;
use org\bovigo\vfs\vfsStream;

abstract class TestCase extends PHPUnit_Framework_TestCase
{
    /** @var vfsStreamDirectory */
    protected $root;

    /** @var string */
    protected $file1;

    /** @var string */
    protected $file2;

    /** @var string */
    protected $file3;

    /** @var ParserInterface */
    protected $parser;

    public function setUp()
    {
        $this->parser = new MarkdownParser();
        $this->root = vfsStream::setup('docs');

        $this->file1 = vfsStream::url('docs/file1.md');
        $this->file2 = vfsStream::url('docs/file2.md');
        $this->file3 = vfsStream::url('docs/file3.md');

        file_put_contents($this->file1, "---\ntitle: File 1\ncategories: [cat1, cat2]---\nfile1 content");
        file_put_contents($this->file2, "---\ntitle: File 2\ncategories: [cat2, cat3]---\nfile2 content");
        file_put_contents($this->file3, "---\ntitle: File 3\ncategories: [cat3, cat4]---\nfile4 content");
    }
}
