<?php

namespace EVB\OneHundred;

/**
 * Interface for a player.
 */
interface IPlayer
{
    public function getLastRoll();

    public function rolledOnes();

    public function getTempScore();

    public function getTotalScore();

    public function roll();

    public function save();
}
