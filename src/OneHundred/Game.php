<?php

namespace EVB\OneHundred;

/**
 * Class for the game onehundred.
 */
class Game
{
    /**
     * @var int Max times the computer rolls before saving.
     */
    private $computerRisk;

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
    public function __construct(IPlayer $player, IPlayer $computer, int $computerRisk)
    {
        $this->computerRisk = $computerRisk;
        $this->player = $player;
        $this->computer = $computer;
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
        $times = \random_int(1, $this->computerRisk);
        $results = "";

        for ($i = 0; $i < $times; $i++) {
            $this->computer->roll();
            $results .= "(" . \implode(", ", $this->computer->getLastRoll()) . ") ";
            if ($this->computer->rolledOnes()) {
                $this->computerResults = $results;
                return;
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
}