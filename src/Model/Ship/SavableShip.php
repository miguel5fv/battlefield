<?php

namespace Model\Ship;

use Model\Savable;

/**
 * Class SavableShip represents those ships available to be saved and loaded.
 *
 * @package Model\Ship
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
abstract class SavableShip extends BaseShip implements Savable
{
    /**
     * Converts the class into a legible array.
     *
     * @return array
     */
    public function save()
    {
        return array(
            'classname' => get_class($this),
            'data'      => array('hits' => $this->hits)
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
        if (isset($data['hits'])) {
            $this->hits = $data['hits'];

            return true;
        }

        return false;
    }
}