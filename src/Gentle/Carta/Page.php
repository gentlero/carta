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
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;
use SplFileInfo;

/**
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class Page implements PageInterface
{
    /**
     * @var SplFileInfo
     */
    protected $file;

    /**
     * Page content
     * @var string
     */
    protected $source;

    /**
     * Page content without header
     * @var string
     */
    protected $content;

    /**
     * @var ParserInterface
     */
    protected $parser;

    /**
     * Meta params
     * @var array
     */
    protected $meta = array();

    /**
     * @param  string                    $file
     * @param  ParserInterface           $parser
     * @return self
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($file, ParserInterface $parser)
    {
        if (!is_file($file)) {
            throw new \InvalidArgumentException('Invalid file specified.');
        }

        $this->file     = new SplFileInfo($file);
        $this->parser   = $parser;
        $this->source   = file_get_contents($file);

        $this->parseFile();
    }

    /**
     * {@inheritDoc}
     */
    public function getContent()
    {
        return $this->parser->transform($this->content);
    }

    /**
     * {@inheritDoc}
     */
    public function getMetaTags()
    {
        return $this->meta;
    }

    /**
     * {@inheritDoc}
     */
    public function getMetaTag($name)
    {
        return isset($this->meta[$name]) ? $this->meta[$name] : null;
    }

    /**
     * {@inheritDoc}
     */
    public function setMetaTag($name, $value)
    {
        $this->meta[$name] = $value;

        return $this;
    }

    /**
     * Extract meta tags and content
     *
     * @access protected
     * @return bool
     */
    protected function parseFile()
    {
        /**
         * Extract file header
         *
         * header MUST be delimited by 3 dashes minimum
         *
         * <example>
         * ---
         * key1: value
         * key2: value1, value2
         * ---
         * </example>
         */
        preg_match("/-{3,}(.*?)-{3,}/ms", $this->source, $match);

        try {
            $this->meta     = Yaml::parse($match[1]);
            $this->content  = preg_replace("/-{3,}(.*?)-{3,}/ms", "", $this->source);

            return true;
        } catch (ParseException $e) {
            return false;
        }
    }
}
