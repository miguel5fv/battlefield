<?php

namespace Model\Ship;

/**
 * Class BaseShip represent the abstaction of ships objects.
 *
 * @package Model\Ship
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
abstract class BaseShip
{
    /**
     * @var integer
     */
    protected $squares;

    /**
     * @var integer
     */
    protected $hits     = 0;

    /**
     * @return integer
     */
    public function getSquares()
    {
        return $this->squares;
    }

    /**
     * Increment the number of hits the ship has recieved.
     *
     * @return BaseShip
     */
    public function hit()
    {
        if ($this->hits < $this->squares)
            $this->hits++;

        return $this;
    }

    /**
     * Check if the ship is sunk.
     *
     * @return bool
     */
    public function isSunk()
    {
        return $this->squares == $this->hits;
    }
}