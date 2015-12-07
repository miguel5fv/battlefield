<?php
namespace Model\Grid;

use Model\Ship\Destroyer;
use Model\Ship\Battleship;
use Model\Ship\BaseShip;
use Model\Savable;
use Model\Ship\Shuffle;

/**
 * Ships class is the grid where the ships are located.
 *
 * @package Model\Grid
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
class Ships extends BaseGrid implements Savable
{
    /**
     * @const integer
     */
    const EMPTY_SHIPS   = 1;

    /**
     * @var string
     */
    protected $value    = ' ';

    /**
     * @var array
     */
    protected $ships    = array(' ');

    /**
     * Prepares the grid to be used.
     */
    public function buildGrid()
    {
        parent::buildGrid();
        $shipBattleship  = new Battleship();
        $shipDestroyer1  = new Destroyer();
        $shipDestroyer2  = new Destroyer();
        $shufflerShips   = new Shuffle();

        $this->addShip($shipBattleship);
        $this->addShip($shipDestroyer1);
        $this->addShip($shipDestroyer2);

        $shufflerShips->setGrid($this->grid);
        $shufflerShips->shuffleShip($shipBattleship->getSquares(), 1);
        $shufflerShips->shuffleShip($shipDestroyer1->getSquares(), 2);
        $shufflerShips->shuffleShip($shipDestroyer2->getSquares(), 3);
        $this->grid = $shufflerShips->getGrid();
    }

    /**
     * Add a new ship in the grid.
     *
     * @param BaseShip $ship
     */
    public function addShip(BaseShip $ship)
    {
        $this->ships[]  = $ship;
    }

    /**
     * Retrieve a BaseShip instance from a given grid value position.
     *
     * @param $position
     * @return bool
     */
    public function getShipByPosition($position) {
        if (false !== $position && $this->value != $position) {
            return $this->ships[$position];
        }

        return false;
    }

    /**
     * Update the BaseShip instance for a new one.
     *
     * @param BaseShip $ship
     * @param integer $position
     */
    public function updateShip(BaseShip $ship, $position)
    {
        $this->ships[$position] = $ship;
    }

    /**
     * Count the number of ships located in the grid.
     *
     * @return int
     */
    public function countShips()
    {
        return count($this->ships) - self::EMPTY_SHIPS;
    }

    /**
     * Converts the class into a legible array.
     *
     * @return array
     */
    public function save()
    {
        return array(
            'grid'  => $this->grid,
            'ships' => $this->saveShips()
        );
    }

    /**
     * Converts the collection of ships into a legible array data.
     *
     * @return array
     */
    protected function saveShips()
    {
        $savedShips = array();

        foreach($this->ships as $key => $ship) {
            if (0 == $key) {
                $savedShips[$key]   = $ship;
            } else {
                $savedShips[$key]   = $ship->save();
            }
        }

        return $savedShips;
    }

    /**
     * Reads a specific array data to fill the key class properties.
     *
     * @param array $data
     * @return bool
     */
    public function load(array $data)
    {
        if (isset($data['grid'], $data['ships'])) {
            $this->grid = $data['grid'];
            $this->openShips($data['ships']);

            return true;
        }

        return false;
    }

    /**
     * Reads a specific array data to create a set of ships.
     *
     * @param array $ships
     */
    protected function openShips(array $ships)
    {
        unset($ships[0]);

        foreach($ships as $key => $ship) {
            $this->ships[$key]   = new $ship['classname'];
            $this->ships[$key]->load($ship['data']);
        }
    }
}