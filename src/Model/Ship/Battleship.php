<?php

namespace Model\Ship;

/**
 * Class Destroyer represents a destroyer ship.
 *
 * @package Model\Ship
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
class Battleship extends SavableShip
{
    /**
     * @var integer
     */
    protected $squares  = 5;
}