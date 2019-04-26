<?php

namespace EVB\OneHundred;

/**
 * Simple predictable DiceHand, 1
 */
class OneSidedDiceHand implements IDiceHand
{
    private $values = [];

    public function roll()
    {
        $this->values = [1];
    }

    public function values()
    {
        return $this->values;
    }

    public function hasOnes()
    {
        return true;
    }

    public function sum()
    {
        return 1;
    }
}
