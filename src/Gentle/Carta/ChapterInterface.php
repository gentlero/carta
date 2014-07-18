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
interface ChapterInterface
{
    /**
     * @access public
     * @return PageInterface[]
     */
    public function getPages();
}
