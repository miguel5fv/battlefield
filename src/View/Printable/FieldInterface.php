<?php

namespace View\Printable;

use  Model\Form\Field;

/**
 * Interface that represent a form field in html format.
 *
 * @package View\Printable
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
interface FieldInterface
{
    /**
     * Converts a given Field\FieldInterface object into html string format.
     *
     * @param Field\FieldInterface $field
     * @return string
     */
    public function toString(Field\FieldInterface $field);
}