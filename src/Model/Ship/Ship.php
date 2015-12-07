<?php
namespace Model\Ship;

abstract class Ship
{
    protected $squares;

    protected $hits = 0;

    public function __construct()
    {
        $this->squares  = self::SQUARES;
    }

    public function getSquares()
    {
        return $this->squares;
    }

    public function hit()
    {
        if ($this->hits < $this->squares)
            $this->hits++;

        return $this;
    }

    public function isSunk()
    {
        return $this->squares == $this->hits;
    }
}