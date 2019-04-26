<?php

namespace EVB\OneHundred;

/**
 * Factory for dices only returning 42.
 */
class AnswerToLifeDiceFactory implements IDiceFactory
{
    public function create()
    {
        return new AnswerToLifeDice();
    }
}
