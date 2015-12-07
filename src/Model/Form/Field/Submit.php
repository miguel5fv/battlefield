<?php

namespace Model\Form\Field;

use View\Printable;

/**
 * Submit class represents the submit button of a form.
 *
 * @package Model\Form\Field
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
class Submit implements FieldInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * Sets the name of the field.
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Retrieve the name of the input.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Retrieve the string html representation of the current object.
     *
     * @return string
     */
    public function toString()
    {
        $printableSubmit = new Printable\Submit();
        return $printableSubmit->toString($this);
    }
}