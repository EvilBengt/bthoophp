<?php

namespace EVB\OneHundred;

/**
 * Unfortunate but predictable player.
 */
class UnfortunatePlayer implements IPlayer
{
    public function getLastRoll()
    {
        return [1];
    }

    public function rolledOnes()
    {
        return true;
    }

    public function getTempScore()
    {
        return 0;
    }

    public function getTotalScore()
    {
        return 0;
    }

    public function roll()
    {
    }

    public function save()
    {
    }
}
