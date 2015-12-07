<?php

namespace View;

use Model\Grid\BaseGrid as ModelBaseGrid;

/**
 * Class Grid manage all the output html of a given grid.
 *
 * @package View
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
class Grid implements ViewInterface
{
    /**
     * @var string
     */
    protected $output;

    /**
     * Prepare a Grid object to be renderized.
     *
     * @param ModelBaseGrid $grid
     */
    public function prepare(ModelBaseGrid $grid)
    {
        $gridArray  = $grid->getGrid();
        $output     = '';

        foreach($gridArray as $yPosition => $xPositions) {
            $output = $this->getHeaderTableFromKeyArray($output, $xPositions);
            $output = $this->getLineValues($output, $yPosition, $xPositions);
        }

        $this->output = "<pre>$output</pre>";
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
     * Creates the head of the grid.
     *
     * @param string $output
     * @param array $xPositions
     *
     * @return string
     */
    protected function getHeaderTableFromKeyArray($output, array $xPositions)
    {
        if (empty($output)) {
            $output = '  ' . implode('', array_keys($xPositions)) . PHP_EOL;
        }
        return $output;
    }

    /**
     * Creates the html representation of a given grid line.
     *
     * @param string $output
     * @param integer $yPosition
     * @param array $xPositions
     *
     * @return string
     */
    protected function getLineValues($output, $yPosition, array $xPositions)
    {
        $partialOutput  = $yPosition . ' ' . implode( '', $xPositions) .  PHP_EOL;
        $output         .= preg_replace('@[0-9]@', 'X', $partialOutput);

        return $output;
    }
}