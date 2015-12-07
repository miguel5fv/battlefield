<?php

namespace View\Printable;

use  Model\Form\Field;

/**
 * Html form Input field in Html format.
 *
 * @package View\Printable
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
class Input
{
    /**
     * Converts an object Field\Input in its html representation.
     *
     * @param Field\Input $input
     * @return string
     */
    public function toString(Field\Input $input)
    {
        return "<input type='input' size='{$input->getSize()}' name='{$input->getName()}' autofocus>";
    }
}