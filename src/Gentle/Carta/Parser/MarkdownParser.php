<?php

/**
 * This file is part of the Carta package.
 *
 * (c) Alexandru G. <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gentle\Carta\Parser;

use Michelf\MarkdownExtra;

/**
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class MarkdownParser implements ParserInterface
{
    /**
     * {@inheritDoc}
     */
    public function transform($data)
    {
        $markdown = new MarkdownExtra();

        return $markdown->transform($data);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'markdown';
    }

    /**
     * {@inheritDoc}
     */
    public function getExtensions()
    {
        return array('.md', '.mdown', '.markdown');
    }
}
