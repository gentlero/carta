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

use Gentle\Carta\Parser\MarkdownParser;
use Gentle\Carta\Parser\ParserInterface;
use SplFileInfo;

/**
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Carta
{
    /**
     * @var SplFileInfo
     */
    protected $root_path;

    /**
     * @var ParserInterface
     */
    protected $parser;

    /**
     * @access public
     * @param  string                 $root_dir
     * @param  Parser\ParserInterface $parser
     * @return self
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($root_dir = null, ParserInterface $parser = null)
    {
        if (!is_null($root_dir)) {
            $this->setRootPath($root_dir);
        }

        $this->parser = !is_null($parser) ? $parser : new MarkdownParser();
    }

    /**
     * @access public
     * @param  string        $file
     * @return PageInterface
     *
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public function page($file)
    {
        return new Page($this->getFullPath($file), $this->parser);
    }

    /**
     * @access public
     * @param  string           $dir
     * @return ChapterInterface
     *
     * @throws \InvalidArgumentException
     */
    public function chapter($dir)
    {
        return new Chapter($this->getFullPath($dir), $this->parser);
    }

    /**
     * @param  string                         $path File or directory
     * @return ChapterInterface|PageInterface
     *
     * @throws \InvalidArgumentException
     */
    public function open($path)
    {
        $full_path = $this->getFullPath($path);

        if (!is_file($full_path) && !is_dir($full_path)) {
            throw new \InvalidArgumentException('Invalid path provided.');
        }

        return is_dir($full_path) ? $this->chapter($path) : $this->page($path);
    }

    /**
     * @access public
     * @param  string $path
     * @return $this
     *
     * @throws \InvalidArgumentException
     */
    public function setRootPath($path)
    {
        if (!is_dir($path)) {
            throw new \InvalidArgumentException('Specified source directory does not exist.');
        }

        $this->root_path = new SplFileInfo($path);

        return $this;
    }

    /**
     * @access public
     * @return SplFileInfo
     */
    public function getRootPath()
    {
        return $this->root_path;
    }

    /**
     * Prepend root dir to given path
     *
     * @access private
     * @param  string $path
     * @return string
     */
    private function getFullPath($path)
    {
        return $this->getRootPath()->getPathname().'/'.ltrim($path, '/');
    }
}
