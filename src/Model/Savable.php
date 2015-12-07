<?php

namespace Model;

/**
 * Savable interface represents the contract between expected savable object.
 *
 * @package Model
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
interface Savable
{
    /**
     * Contract of the save method.
     *
     * @return array
     */
    public function save();

    /**
     * Contract of the load into the object savable data.
     *
     * @param array $data
     */
    public function load(array $data);
}