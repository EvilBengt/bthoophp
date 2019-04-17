<?php
/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Guess
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

    /**
     * Get number of tries left.
     *
     * @return int as number of tries left.
     */
    public function getTries()
    {
        return $this->tries;
    }



    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */
    public function getNumber()
    {
        return $this->number;
    }



    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     *
     * @throws GuessException when guessed number is out of bounds.
     *
     * @return string to show the status of the guess made.
     */
    public function makeGuess($number)
    {
        if ($this->gameOver) {
            return "Spelet är över!";
        }

        if ($this->tries == 0) {
            $this->gameOver = true;
            return "Inga mer gissningar!";
        }

        if ($number < 1 || $number > 100) {
            throw new GuessException();
        }

        $this->tries--;

        if ($number == $this->number) {
            $this->gameOver = true;
            return "Korrekt!";
        }

        if ($number < $this->number) {
            return "För lågt!";
        }

        if ($number > $this->number) {
            return "För högt!";
        }
    }
}
