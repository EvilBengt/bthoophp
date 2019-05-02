<?php

namespace EVB\OneHundred;

/**
 * Class for the game onehundred.
 */
class Game
{
    /**
     * @var Histogram Histogram for dice rolls.
     */
    private $histogram;

    /**
     * @var Player The player.
     */
    private $player;

    /**
     * @var Player The computer.
     */
    private $computer;

    /**
     * @var string The result from the computers last turn.
     */
    private $computerResults;

    /**
     * @var string The winner, if any.
     */
    private $winner = "";

    /**
     * Initiates a new game and sets a random number.
     * @param int $maxTries Maximum number of tries.
     */
    public function __construct(IDice $diceForHistogram, IPlayer $player, IPlayer $computer)
    {
        $this->player = $player;
        $this->computer = $computer;
        $this->histogram = new Histogram($diceForHistogram);
    }

    public function getLastRoll()
    {
        return $this->player->getLastRoll();
    }

    public function playerRolledOnes()
    {
        return $this->player->rolledOnes();
    }

    public function getPlayerTempScore()
    {
        return $this->player->getTempScore();
    }

    public function getPlayerTotalScore()
    {
        return $this->player->getTotalScore();
    }

    public function getComputerTotalScore()
    {
        return $this->computer->getTotalScore();
    }

    public function rollPlayer()
    {
        $this->player->roll();
    }

    public function savePlayer()
    {
        $this->player->save();
        if ($this->player->getTotalScore() >= 100) {
            $this->winner = "Du";
        }
    }

    public function playComputer()
    {
        $results = "";

        $sum = 0;

        for ($i = 0; $i < 5; $i++) {
            $this->computer->roll();
            $results .= "(" . \implode(", ", $this->computer->getLastRoll()) . ") ";

            if ($this->computer->rolledOnes()) {
                $this->computerResults = $results;
                return;
            }

            $roll = array_sum($this->computer->getLastRoll());
            $sum += $roll;

            if ($this->computer->getTotalScore() - $this->player->getTotalScore() > 10) {
                if ($sum > 10) {
                    break;
                }
            }
        }
        $this->computerResults = $results;
        $this->computer->save();
        if ($this->computer->getTotalScore() >= 100) {
            $this->winner = "Datorn";
        }
    }

    public function getComputerResults()
    {
        return $this->computerResults;
    }

    public function getWinner()
    {
        return $this->winner;
    }

    public function getHistogram()
    {
        $this->histogram->update();
        return $this->histogram->getAsText();
    }
}
