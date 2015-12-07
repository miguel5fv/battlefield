<?php

namespace Model\Form\Field;

use View\Printable;

/**
 * Input class represents an input form field of type input.
 *
 * @package Model\Form\Field
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
class Input implements FieldInterface
{
    /**
     * @var integer
     */
    protected $size;

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
     * Sets the size of the text if the $size value is correct.
     *
     * @param string $size
     * @return bool
     */
    public function setSize($size)
    {
        $output = false;

        if (is_numeric($size) && $size > 0)
        {
            $this->size = $size;
            $output     = true;
        }

        return $output;
    }

    /**
     * Retrieve the text size of the input.
     *
     * @return integer
     */
    public function getSize()
    {
        return $this->size;
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
        $printableInput = new Printable\Input();
        return $printableInput->toString($this);
    }
}