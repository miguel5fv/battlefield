<?php

namespace CommonTraits;

trait Coordinates
{
    /**
     * Converts the numeric position to alphanumeric position.
     *
     * @param integer $yPosition
     * @return string
     */
    protected function fromYPositionToChar($yPosition)
    {
        return chr($yPosition + self::MAP_NUM_TO_CHAR);
    }
}