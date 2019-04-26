<?php

namespace EVB\OneHundred;

/**
 * Dice only returning 42.
 */
class AnswerToLifeDice implements IDice
{
    public function roll()
    {
        return 42;
    }
}
