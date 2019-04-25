<?php

namespace EVB\OneHundred;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class OneHundred
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries left.
     */
    private $number;
    private $tries;
    private $gameOver = false;

    /**
     * Initiates a new game and sets a random number.
     * @param int $maxTries Maximum number of tries.
     */
    public function __construct(int $maxTries = 6)
    {
        $this->number = random_int(1, 100);
        $this->tries = $maxTries;
    }
}
