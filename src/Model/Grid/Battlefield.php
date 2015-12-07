<?php

namespace Model\Grid;

use Model\Savable;

/**
 * Battlefield class is the grid where the user interact trying to sunk ships.
 *
 * @package Model\Grid
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
class Battlefield extends BaseGrid implements Savable
{
    /**
     * @const string
     */
    const DEFAULT_VALUE = '.';

    /**
     * @const string
     */
    const HIT_VALUE     = 'X';

    /**
     * @const string
     */
    const MISS_VALUE    = '-';

    /**
     * @var Ships
     */
    protected $shipsGrid;

    /**
     * @var bool
     */
    protected $isSunk       = false;

    /**
     * @var integer
     */
    protected $sunkShips    = 0;

    /**
     * Add a new ship grid. That means new ship location.
     *
     * @param Ships $shipGrid
     */
    public function addShipGrid(Ships $shipGrid)
    {
        $this->shipsGrid   = $shipGrid;
    }

    /**
     * Retrieve the ship grid distribution.
     *
     * @return Ships
     */
    public function getShipGrid()
    {
        return $this->shipsGrid;
    }

    /**
     * Process a request for hit a ship.
     *
     * @param integer $yPosition
     * @param integer $xPosition
     * @return bool
     */
    public function hitPosition($yPosition, $xPosition)
    {
        $shipPosition   = $this->shipsGrid->getPosition($yPosition, $xPosition);
        $position       = $this->getPosition($yPosition, $xPosition);
        $output         = false;

        $this->isSunk       = false;
        $this->currentShip  = $this->shipsGrid->getShipByPosition($shipPosition);

        if (false !== $this->currentShip && self::DEFAULT_VALUE == $position) {
            $this->currentShip->hit();
            $this->sunkConsequences();

            $this->shipsGrid->updateShip($this->currentShip, $shipPosition);
            $output = true;
        } else if (self::HIT_VALUE == $position){
            $output = true;
        }

        return $output;
    }

    /**
     * Checks if the current hit has sunk a ship.
     * @return bool
     */
    public function isShipSunk()
    {
        return $this->isSunk;
    }

    /**
     * Updates the battlefield properties related with sunks
     */
    protected function sunkConsequences()
    {
        $this->isSunk   = $this->currentShip->isSunk();

        if (true === $this->isSunk)
            $this->sunkShips++;
    }

    /**
     * Mark the current position as hit.
     *
     * @param integer $yPosition
     * @param integer $xPosition
     */
    public function markPositionAsHit($yPosition, $xPosition)
    {
        $this->grid[$yPosition][$xPosition] = self::HIT_VALUE;
    }

    /**
     * Mark the current position as miss.
     *
     * @param integer $yPosition
     * @param integer $xPosition
     */
    public function markPositionAsMiss($yPosition, $xPosition)
    {
        $this->grid[$yPosition][$xPosition] = self::MISS_VALUE;
    }

    /**
     * Checks if the player has sunk all the ships.
     *
     * @return bool
     */
    public function isCompleteGame()
    {
        return $this->sunkShips === $this->shipsGrid->countShips();
    }

    /**
     * Converts the class into a legible array.
     *
     * @return array
     */
    public function save()
    {
        return array(
            'isSunk'    => $this->isSunk,
            'sunkShips' => $this->sunkShips,
            'grid'      => $this->grid,
            'shipsGrid' => $this->shipsGrid->save()
        );
    }

    /**
     * Reads a specific array data to fill the key class properties.
     *
     * @param array $data
     * @return bool
     */
    public function load(array $data)
    {
        if (isset($data['isSunk'], $data['sunkShips'], $data['grid'], $data['shipsGrid'])) {
            $this->isSunk       = $data['isSunk'];
            $this->sunkShips    = $data['sunkShips'];
            $this->grid         = $data['grid'];

            $this->shipsGrid  = new Ships();
            $this->shipsGrid->load($data['shipsGrid']);

            return true;
        }

        return false;
    }
}