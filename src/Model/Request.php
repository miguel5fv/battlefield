<?php

namespace Model;

use Model\Form\Form;
use Model\Form\Field;

/**
 * Request class manage the input data.
 *
 * @package Model\Grid
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
class Request
{
    /**
     * @var Form
     */
    protected $form;

    /**
     * Creates an object representation of a html form.
     */
    public function createForm($action)
    {
        $this->form = new Form();
        $label = new Field\Label();
        $input = new Field\Input();
        $submit = new Field\Submit();

        $label->setMessage('Enter coordinates (row, col), e.g. A5');

        $input->setSize(5);
        $input->setName('coord');
        $submit->setName('submit');

        $this->form->addField($label);
        $this->form->addField($input);
        $this->form->addField($submit);
        $this->form->setPostMethod();
        $this->form->setAction($action);

        $this->form->loadDataSubmitted();
    }

    /**
     * Retrieve the current configured form.
     *
     * @return Form
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * Retrieve coords from formulary.
     *  - null means no coordinates given.
     *  - false means incorrect coordinate format.
     *
     * @param array $dataForm
     * @return null|bool|string
     */
    public function retrieveCoord()
    {
        $coord = $this->form->getParameterData('coord');

        return is_null($coord) ? $coord : $this->coordsFromStringToArray($coord);
    }

    /**
     * Converts a given string coords to an array.
     *
     * If the string not follow the expected input format, falses is returned.
     *
     * @param string $coord
     * @return false|array
     */
    protected function coordsFromStringToArray($coord)
    {
        if (0 < preg_match('@^(?P<yPos>[A-J])(?P<xPos>[0-9])$@', strtoupper($coord), $coordSplit)) {
            return $coordSplit;
        }

        return false;
    }

    /**
     * Check if the submit form value use the show command to debug.
     *
     * @param string $coord
     * @return bool
     */
    public function isDebug()
    {
        $coords = $this->form->getParameterData('coord');
        return !is_null($coords) && 'show' == $coords;
    }
}