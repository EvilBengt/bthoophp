<?php

namespace EVB\OneHundred;

/**
 * A class representing a dice
 */
class Dice implements IDice
{
    protected $sides;

    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
    }

    public function roll()
    {
        $roll = random_int(1, $this->sides);
        return $roll;
    }
}
