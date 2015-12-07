<?php

namespace Model\Ship;

use Service\CoordinatesTrait;

/**
 * Class Shuffle have the mission to shuffle a ship into a given grid:
 *
 *  - This class ensure that the new ship never collision with an existing ship.
 *  - This class ensures the randomness ship shuffle.
 *
 * The strategy usage is simple. When a ship is located, we divide the grid in two
 * different grids (if the ship is located in horizontal the grid will be divided in horizontal,
 * the same in vertical). We locate the next ship into the greatest grid resultant, and then
 * divide that grid in two new mores, and we will work with the smallest one.
 *
 * @package Model\Ship
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
class Shuffle
{
    use CoordinatesTrait;

    /**
     * @var array
     */
    protected $grid = array();

    /**
     * @var array
     */
    protected $limits = array(
        'minX' => 1,
        'maxX' => 10,
        'minY' => 1,
        'maxY' => 10,
    );

    /**
     * Set the grid to work with.
     *
     * @param array $grid
     */
    public function setGrid(array $grid)
    {
        $this->grid = $grid;
    }

    /**
     * Retrieve the grid used.
     *
     * @return array
     */
    public function getGrid()
    {
        return $this->grid;
    }

    /**
     * Given a ship represented with an id and square length, we located it randomly and
     * without collisions into the grid.
     *
     * @param integer $squares
     * @param integer $idShip
     */
    public function shuffleShip($squares, $idShip)
    {
        if ($this->willBeDisplayedHorizontal($squares)) {
            $xPosition = rand($this->limits['minX'], $this->limits['maxX'] - $squares);
            $yPosition = rand($this->limits['minY'], $this->limits['maxY']);

            $this->shuffleHorizontalShip(
                $idShip,
                $squares,
                $this->fromYPositionToChar($yPosition),
                $xPosition
            );

            $this->adjutsLimits($yPosition, 'Y');
        } else {
            $xPosition = rand($this->limits['minX'], $this->limits['maxX']);
            $yPosition = rand($this->limits['minY'], $this->limits['maxY'] - $squares);
            $this->shuffleVerticalShip($idShip, $squares, $yPosition, $xPosition);

            $this->adjutsLimits($xPosition, 'X');
        }
    }

    /**
     * Check if the ship will be located horizontally. The strategy:
     *
     *  - If the ship fits into the horizontal space of the grid.
     *  - And in case of doesn't fit vertical it is mandatorya to located it horizontal.
     *  - Randomly if fits horizontal.
     *
     * @param integer $squares
     * @return bool
     */
    protected function willBeDisplayedHorizontal($squares)
    {
        return $this->fitInPosition($squares, 'X')
            && (
                !$this->fitInPosition($squares, 'Y')
                || 0 == rand(0, 1)
            );
    }

    /**
     * Checks if the length of a ship fits into the given X or Y position.
     *
     * @param integer $squares
     * @param string $positionName
     * @return bool
     */
    protected function fitInPosition($squares, $positionName)
    {
        return $this->limits['max' . $positionName] - $this->limits['min' . $positionName] >= $squares;
    }

    /**
     * Locates the ship in horizontal position.
     *
     * @param integer $idShip
     * @param integer $squares
     * @param integer $yPosition
     * @param integer $xPosition
     */
    protected function shuffleHorizontalShip($idShip, $squares, $yPosition, $xPosition)
    {
        for ($xIndex = 0; $xIndex < $squares; $xIndex++) {
            $currentX  = $xPosition + $xIndex;
            $this->grid[$yPosition][$currentX%10] = $idShip;
        }
    }

    /**
     * Locates the ship in vertical position.
     *
     * @param integer $idShip
     * @param integer $squares
     * @param integer $yPosition
     * @param integer $xPosition
     */
    protected function shuffleVerticalShip($idShip, $squares, $yPosition, $xPosition)
    {
        for ($yIndex = 0; $yIndex < $squares; $yIndex++) {
            $currentY   = $this->fromYPositionToChar($yPosition + $yIndex);
            $this->grid[$currentY][$xPosition%10] = $idShip;
        }
    }

    /**
     * Updates the limits of the grid in order to follow the strategy to use the greatest
     * divided grid.
     *
     * @param intger $position
     * @param string $positionName
     */
    protected function adjutsLimits($position, $positionName)
    {
        $minDiff = $position - $this->limits['min' . $positionName];
        $maxDiff = $this->limits['max' . $positionName] - $position;

        if ($minDiff < $maxDiff) {
            $this->limits['min' . $positionName] = $position + 1;
        } else {
            $this->limits['max' . $positionName] = $position - 1;
        }
    }
}