<?php

namespace Model\Grid;

use Service\CoordinatesTrait;

/**
 * BaseGrid class represents the common grid objects.
 *
 * @package Model\Grid
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
abstract class BaseGrid
{
    use CoordinatesTrait;

    /**
     * @const integer
     */
    const FIRST_GRID_POSITION   = 1;

    /**
     * @const integer
     */
    const MAX_GRID_SIZE_Y       = 10;

    /**
     * @const integer
     */
    const MAX_GRID_SIZE_X       = 10;

    /**
     * @var array
     */
    protected $grid;

    /**
     * Field grid default value.
     *
     * @var string
     */
    protected $value    = '.';

    /**
     * Initialize the grid filling it with the default value.
     */
    public function buildGrid()
    {
        for ($index = self::FIRST_GRID_POSITION; $index <= self::MAX_GRID_SIZE_Y; $index++) {
            $this->grid[$this->fromYPositionToChar($index)] = array_fill(
                self::FIRST_GRID_POSITION,
                self::MAX_GRID_SIZE_X - 1,
                $this->value
            );

            $this->grid[$this->fromYPositionToChar($index)][0] = $this->value;
        }
    }

    /**
     * Retrieve the value of a given grid position.
     *
     * @param integer $yPosition
     * @param integer $xPosition
     * @return bool
     */
    public function getPosition($yPosition, $xPosition)
    {
        if (isset($this->grid[$yPosition][$xPosition]))
            return $this->grid[$yPosition][$xPosition];

        return false;
    }

    /**
     * Retrieve the grid.
     *
     * @return array
     */
    public function getGrid()
    {
        return $this->grid;
    }

    /**
     * Sets a new one grid.
     *
     * @param array $grid
     */
    public function setGrid(array $grid)
    {
        $this->grid = $grid;
    }
}