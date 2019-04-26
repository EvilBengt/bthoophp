<?php

namespace EVB\OneHundred;

/**
 * A dicehand, consisting of dices.
 */
class NormalDiceHand implements IDiceHand
{
    /**
     * @var array<Dice> $dices   Array consisting of dices.
     */
    private $dices;

    /**
     * @var array<int>  $values  Array consisting of last roll of the dices.
     */
    private $values;

    /**
     * Constructor to initiate the dicehand with a number of dices.
     *
     * @param int $dices Number of dices to create, defaults to five.
     */
    public function __construct(int $dices, IDiceFactory $diceFactory)
    {
        $this->dices  = [];
        $this->values = [];

        for ($i = 0; $i < $dices; $i++) {
            $this->dices[]  = $diceFactory->create();
        }
    }

    /**
     * Roll all dices and save their value.
     *
     * @return void.
     */
    public function roll()
    {
        $this->values = [];
        foreach ($this->dices as $dice) {
            $this->values[] = $dice->roll();
        }
    }

    /**
     * Get values of dices from last roll.
     *
     * @return array with values of the last roll.
     */
    public function values()
    {
        return $this->values;
    }

    /**
     * Returns whether the last roll contained ones.
     *
     * @return array with values of the last roll.
     */
    public function hasOnes()
    {
        foreach ($this->values as $value) {
            if ($value == 1) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get the sum of all dices.
     *
     * @return int as the sum of all dices.
     */
    public function sum()
    {
        return array_sum($this->values);
    }
}
