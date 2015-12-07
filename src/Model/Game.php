<?php

namespace Model;

use Model\Grid\Ships;
use Model\Grid\Battlefield;

/**
 * Game class is needed to make persistent the status of the game.
 *
 * @package Model
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
class Game
{
    /**
     * @var integer
     */
    protected $shots = 0;

    /**
     * @var Battlefield
     */
    protected $battlefield;

    /**
     * @var FlashMessage
     */
    protected $flashMessage;

    /**
     * @var boolean
     */
    protected $debug;

    /**
     * @var false|array
     */
    protected $coords;

    /**
     * This method tries creates load the stored data a initiate the needed class instances.
     */
    public function initialize()
    {
        $this->flashMessage     = new FlashMessage();
        $this->load();
    }

    /**
     * Retrieve a battlefield.
     *
     * @return Battlefield
     */
    public function getBattlefield()
    {
        return $this->battlefield;
    }

    /**
     * Returns the object Flash message
     *
     * @return FlashMessage
     */
    public function getFlashMessage()
    {
        return $this->flashMessage;
    }

    /**
     * Retrieve the number of shots done during the game.
     *
     * @return int
     */
    public function getShots()
    {
        return $this->shots;
    }

    /**
     * Mark the game as debug mode.
     *
     * @param boolean $isDebugMode
     */
    public function setDebugMode($isDebugMode)
    {
        $this->debug    = $isDebugMode;
    }

    /**
     * Sets the coordinates where the actions will happens.
     *
     * @param null|false|array $coords
     */
    public function setCoords($coords)
    {
        $this->coords   = $coords;
    }

    /**
     * Retrieve the grid of ships if it is in debug mode or battlefield in play mode.
     *
     * @return Battlefield|Ships
     */
    public function getGrid()
    {
        if ($this->debug) {
            return $this->battlefield->getShipGrid();
        } else {
            return $this->battlefield;
        }
    }

    /**
     * Process the coordinates given to try to hit a ship.
     */
    public function play()
    {
        if (!$this->debug) {
            if (false === $this->coords) {
                $this->flashMessage->notifyError();
            } else if(!empty($this->coords)) {
                $this->manageShot($this->coords);
            }
        }
    }

    /**
     * This method process the coordinates given to make a ship shot.
     *
     * @param string $coord
     */
    protected function manageShot(array $coord)
    {
        $this->shots++;

        if (true === $this->battlefield->hitPosition($coord['yPos'], $coord['xPos'])) {
            $this->hitAShipt($coord['yPos'], $coord['xPos']);
        } else {
            $this->battlefield->markPositionAsMiss($coord['yPos'], $coord['xPos']);
            $this->flashMessage->notifyMiss();
        }
    }

    /**
     * Process the consequences of hit a ship
     *
     * @param integer $yPosition
     * @param integer $xPosition
     */
    protected function hitAShipt($yPosition, $xPosition)
    {
        $this->battlefield->markPositionAsHit($yPosition, $xPosition);

        if (true === $this->battlefield->isShipSunk()){
            $this->flashMessage->notifySunk();
        } else {
            $this->flashMessage->notifyHit();
        }
    }

    /**
     * Save the current status of the game.
     */
    public function save()
    {
        $_SESSION['shots']          = $this->shots;
        $_SESSION['battlefield']    = $this->battlefield->save();
    }

    /**
     * This method retrieve the stored load by its name.
     */
    public function load()
    {
        $this->battlefield  = new Battlefield();

        if (isset($_SESSION['shots'], $_SESSION['battlefield'])) {
            $this->shots        = $_SESSION['shots'];
            $this->battlefield->load($_SESSION['battlefield']);
        } else {
            $shipsGrid      = new Ships();
            $this->shots    = 0;

            $shipsGrid->buildGrid();
            $this->battlefield->buildGrid();
            $this->battlefield->addShipGrid($shipsGrid);
        }
    }
}