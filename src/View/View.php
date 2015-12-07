<?php

namespace View;

/**
 * Class view manage all the output html representation.
 *
 * @package View
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
class View
{
    /**
     * Set of ViewInterface objects.
     *
     * @var array
     */
    protected $viewObjectCollection = array();

    /**
     * Set a ViewInterface to be renderized.
     *
     * @param ViewInterface $objectView
     */
    public function addViewObject(ViewInterface $objectView)
    {
        $this->viewObjectCollection[]   = $objectView;
    }

    /**
     * Build the complete html page with its ViewInterface renderized.
     */
    public function render()
    {
        $output = $this->prepareHeaderHtml();
        $output = $this->renderViewObjects($output);

        echo $this->endsHtml($output);
    }

    /**
     * Prepares the Html header.
     *
     * @return string
     */
    protected function prepareHeaderHtml()
    {
        return '<html><body>';
    }

    /**
     * Render the whole ViewInterface objects.
     *
     * @param string $output
     * @return string
     */
    protected function renderViewObjects($output)
    {
        foreach($this->viewObjectCollection as $viewObject) {
            $output .= $viewObject->render();
        }

        return $output;
    }

    /**
     * Retrieve the end of the html page representation.
     *
     * @param string $output
     * @return string
     */
    protected function endsHtml($output)
    {
        return $output . '</body></html>';
    }
}