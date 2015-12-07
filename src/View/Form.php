<?php
namespace View;

use Model\Form\Form as ModelForm;

/**
 * View Form representation object.
 *
 * @package View
 * @uthor Miguel Florido <miguel5fv@gmail.com>
 */
class Form implements ViewInterface
{
    /**
     * @var string
     */
    protected $output;

    /**
     * Prepare a Form object to be renderized.
     *
     * @param ModelForm $form
     */
    public function prepare(ModelForm $form)
    {
        $fields = $form->getFields();
        $this->prepareHeadForm($form);
        $this->printFields($fields);
        $this->endFormView();
    }

    /**
     * Returns the form object in Html representation.
     *
     * @return string
     */
    public function render()
    {
        return $this->output;
    }

    /**
     * Creates the head of the form.
     *
     * @param ModelForm $form
     */
    protected function prepareHeadForm(ModelForm $form)
    {
        $this->output = "<form name='input' action='{$form->getAction()}' method='{$form->getMethod()}'>";
    }

    /**
     * Retrieve the Html representation of each form field.
     *
     * @param array $fields
     */
    protected function printFields(array $fields)
    {
        foreach($fields as $field) {
            $this->output .= "\n" . $field->toString();
        }
    }

    /**
     * Retrieve the end form html clause.
     */
    protected function endFormView()
    {
        $this->output .= '</form>';
    }
}