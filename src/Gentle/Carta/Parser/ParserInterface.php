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

/**
 * @author  Alexandru G.    <alex@gentle.ro>
 */
interface ParserInterface
{
    /**
     * Get parser name
     *
     * @access public
     * @return string
     */
    public function getName();

    /**
     * Get supported extensions
     *
     * @access public
     * @return array
     */
    public function getExtensions();

    /**
     * Transform provided string to HTML
     *
     * @access public
     * @param  string $data
     * @return string
     */
    public function transform($data);
} 
