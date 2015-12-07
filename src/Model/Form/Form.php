<?php

namespace Model\Form;

use Model\Form\Field\FieldInterface;

/**
 * Form class contains fields and parameters of an OOP representation of an HTML form.
 *
 * @package Model\Form
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
class Form
{
    /**
     * @var array
     */
    protected $fields   = array();

    /**
     * @var array
     */
    protected $data;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var string
     */
    protected $action;

    /**
     * Add a specific form field.
     *
     * <input, label, submit>
     *
     * @param FieldInterface $field
     * @return Form
     */
    public function addField(FieldInterface $field)
    {
        $this->fields[]    = $field;

        return $this;
    }

    /**
     * Retrieve from headers data submitted.
     */
    public function loadDataSubmitted()
    {
        if (empty($this->data)) {
            $this->data = ('POST' == $this->method) ? $_POST : $_GET;
        }
    }

    /**
     * Sets the form method as POST.
     *
     * @return Form
     */
    public function setPostMethod()
    {
        $this->method   = 'POST';

        return $this;
    }

    /**
     * Sets the form method as GET.
     *
     * @return Form
     */
    public function setGetMethod()
    {
        $this->method   = 'GET';

        return $this;
    }

    /**
     * Sets the action location to be redirected after submit.
     *
     * @param string $action
     *
     * @return Form
     */
    public function setAction($action)
    {
        $this->action   = $action;

        return $this;
    }

    /**
     * Returns the submitted data if exists.
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Retrieve a parameter data by it name.
     *
     * Returns null if not exists.
     *
     * @param string $name
     * @return null|mixed
     */
    public function getParameterData($name)
    {
        if (empty($this->data[$name])) {
            return null;
        }

        return $this->data[$name];
    }

    /**
     * Retrieve the collection of fields.
     *
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Retrieve the location action.
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Retrieve the http method used.
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }
}