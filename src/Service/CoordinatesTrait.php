<?php

namespace Service;

/**
 * CoordinatesTrait trait that contain common grid position methods.
 *
 * @package Service
 * @author Miguel Florido <miguel5fv@gmail.com>
 */
trait CoordinatesTrait
{
    /**
     * @var integer
     */
    protected $mapNumberToChar       = 64;

    /**
     * Converts the numeric position to alphanumeric position.
     *
     * @param integer $yPosition
     * @return string
     */
    protected function fromYPositionToChar($yPosition)
    {
        return chr($yPosition + $this->mapNumberToChar);
    }
}