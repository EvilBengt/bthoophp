<?php

namespace EVB\OneHundred;

/**
 * A factory for creating normal dices.
 */
class NormalDiceFactory implements IDiceFactory
{
    private const DICE_SIDES = 6;

    public function create()
    {
        return new Dice(6);
    }
}
