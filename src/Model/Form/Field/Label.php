<?php

namespace Model\Form\Field;

use View\Printable;

/**
 * Label class represents an informative string of a form.
 *
 * @package Model\Form\Field
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
class Label implements FieldInterface
{
    /**
     * @var string
     */
    protected $message;

    /**
     * Sets the content message of the label if it is not empty.
     *
     * @param string $message
     * @return bool
     */
    public function setMessage($message)
    {
        $output = false;

        if(!empty($message))
        {
            $this->message  = $message;
            $output = true;
        }

        return $output;
    }

    /**
     * Retrieve the content message of the label.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Retrieve the string html representation of the current object.
     *
     * @return string
     */
    public function toString()
    {
        $printableLabel = new Printable\Label();
        return $printableLabel->toString($this);
    }
}