<?php

namespace EVB\OneHundred;

/**
 * Simple predictable DiceHand, 42
 */
class AnswerToLifeDiceHand implements IDiceHand
{
    private $values = [];

    public function roll()
    {
        $this->values = [42];
    }

    public function values()
    {
        return $this->values;
    }

    public function hasOnes()
    {
        return false;
    }

    public function sum()
    {
        return array_sum($this->values);
    }
}
