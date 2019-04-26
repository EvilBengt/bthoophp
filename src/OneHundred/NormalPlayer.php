<?php

namespace EVB\OneHundred;

/**
 * Class representing a player.
 */
class NormalPlayer implements IPlayer
{
    /**
     * @var IDiceHand The players hand.
     */
    private $hand;

    /**
     * @var int The players total score.
     */
    private $score;

    /**
     * @var int The players temporary score.
     */
    private $tempScore;

    public function __construct(IDiceHand $diceHand)
    {
        $this->hand = $diceHand;
        $this->score = 0;
        $this->tempScore = 0;
    }

    public function getLastRoll()
    {
        return $this->hand->values();
    }

    public function rolledOnes()
    {
        return $this->hand->hasOnes();
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
        $this->hand->roll();
        if (!$this->hand->hasOnes()) {
            $this->tempScore += $this->hand->sum();
        } else {
            $this->tempScore = 0;
        }
    }

    public function save()
    {
        $this->score += $this->tempScore;
        $this->tempScore = 0;
    }
}
