<?php

/**
 * This file is part of the Carta package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gentle\Carta;

use Gentle\Carta\Parser\ParserInterface;

/**
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Chapter implements ChapterInterface
{
    /**
     * @var string
     */
    protected $root;

    /**
     * @var ParserInterface
     */
    protected $parser;

    /**
     * @var PageInterface[]
     */
    protected $pages = array();

    public function __construct($path, ParserInterface $parser)
    {
        if (!is_dir($path)) {
            throw new \InvalidArgumentException('Specified chapter path is not a directory.');
        }

        $this->root = $path;
        $this->parser = $parser;
    }

    /**
     * {@inheritDoc}
     */
    public function getPages()
    {
        if (empty($this->pages)) {
            $this->findPages();
        }

        return $this->pages;
    }

    /**
     * @access private
     * @return void
     */
    private function findPages()
    {
        $items = new \DirectoryIterator($this->root);

        foreach ($items as $file) {
            /** @var \DirectoryIterator $file */
            if (
                $file->isFile() &&
                in_array('.'.$file->getExtension(), $this->parser->getExtensions()))
            {
                $this->pages[] = new Page($file->getPathname(), $this->parser);
            }
        }
    }
}
