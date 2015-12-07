<?php

namespace Model\Form\Field;

/**
 * Factory class to create Form fields.
 *
 * @package Model\Form\Field
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
class Factory
{
    /**
     * Represents the label name field.
     */
    CONST LABEL     = 'label';

    /**
     * Represents the label name input.
     */
    CONST INPUT     = 'input';

    /**
     * Represents the label name submit.
     */
    CONST SUBIMIT   = 'submit';

    /**
     * Retrieve a field object.
     *
     * @param string $name
     * @return FieldInterface
     */
    public function getField($name)
    {
        $className  = $this->retrieveClassName($name);
        return new $className;
    }

    /**
     * Retrieve the class name of a field with a given type field name.
     *
     * @param string $name
     * @return string
     */
    private function retrieveClassName($name)
    {
        switch($name){
            case self::LABEL:
            case self::INPUT:
            case self::SUBIMIT:
                return 'Model\\Form\\Field' . ucfirst($name);
            default:
                throw new \InvalidArgumentException("The $name field type does not exists");
        }
    }
}