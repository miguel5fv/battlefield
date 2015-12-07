<?php

namespace View\Printable;

use  Model\Form\Field;

/**
 * Html form Label field in Html format.
 *
 * @package View\Printable
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
class Label
{
    /**
     * Converts an object Field\Label in its html representation.
     *
     * @param Field\Label $label
     * @return string
     */
    public function toString(Field\Label $label)
    {
        return "{$label->getMessage()}";
    }
}