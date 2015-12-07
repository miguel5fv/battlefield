<?php

namespace View\Printable;

use  Model\Form\Field;

/**
 * Html form Submit field in Html format.
 *
 * @package View\Printable
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
class Submit
{
    /**
     * Converts an object Field\Submit in its html representation.
     *
     * @param Field\Submit $submit
     * @return string
     */
    public function toString(Field\Submit $submit)
    {
        return "<input name='{$submit->getName()}' type='submit'>";
    }
}