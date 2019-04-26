<?php

namespace EVB\OneHundred;

/**
 * Simple predictable player.
 */
class SimplePlayer implements IPlayer
{
    private $lastRoll = [];
    private $score = 0;
    private $tempScore = 0;

    public function getLastRoll()
    {
        return $this->lastRoll;
    }

    public function rolledOnes()
    {
        return false;
    }

    public function getTempScore()
    {
        return $this->tempScore;
    }

    public function getTotalScore()
    {
        return $this->score;
    }

    public function roll()
    {
        $this->lastRoll = [101];
        $this->tempScore += 101;
    }

    public function save()
    {
        $this->score += $this->tempScore;
    }
}
