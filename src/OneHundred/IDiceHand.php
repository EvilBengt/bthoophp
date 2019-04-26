<?php

namespace EVB\OneHundred;

/**
 * An interface for a dicehand.
 */
interface IDiceHand
{
    /**
     * Roll all dices and save their value.
     *
     * @return void.
     */
    public function roll();

    /**
     * Get values of dices from last roll.
     *
     * @return array with values of the last roll.
     */
    public function values();

    /**
     * Returns whether the last roll contained ones.
     *
     * @return array with values of the last roll.
     */
    public function hasOnes();

    /**
     * Get the sum of all dices.
     *
     * @return int as the sum of all dices.
     */
    public function sum();
}
