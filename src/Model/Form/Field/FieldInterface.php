<?php
namespace Model\Form\Field;

/**
 * Interface that represents the contract of the whole field form objects..
 *
 * @package Model\Form\Field
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
interface FieldInterface
{
    /**
     * Retrieve the string html representation of the current object.
     *
     * @return string
     */
    public function toString();
}