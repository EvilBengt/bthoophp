<?php

namespace EVB\OneHundred;

/**
 * Factory for dices only returning 1.
 */
class OneSidedDiceFactory implements IDiceFactory
{
    public function create()
    {
        return new Dice(1);
    }
}
