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

use Gregwar\RST\Parser;

/**
 * @author  Alexandru G.    <alex@gentle.ro>
 */
class RestructuredTextParser implements ParserInterface
{
    /**
     * {@inheritDoc}
     */
    public function transform($data)
    {
        $rst = new Parser();

        return $rst->parse($data);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'rst';
    }

    /**
     * {@inheritDoc}
     */
    public function getExtensions()
    {
        return array('.rst');
    }
} 
