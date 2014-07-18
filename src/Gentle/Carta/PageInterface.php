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

/**
 * @author  Alexandru G.    <alex@gentle.ro>
 */
interface PageInterface
{
    public function getContent();

    /**
     * @access public
     * @return array
     */
    public function getMetaTags();

    /**
     * @access public
     * @param  string $name
     * @return mixed
     */
    public function getMetaTag($name);

    /**
     * @access public
     * @param  string $name
     * @param  mixed  $value
     * @return self
     */
    public function setMetaTag($name, $value);
}
