<?php

namespace EVB\Guess;

/**
 * Exception class for when a guess is out of bounds
 */
class GuessException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Det gissade talet var utanför gränserna.");
    }
}
