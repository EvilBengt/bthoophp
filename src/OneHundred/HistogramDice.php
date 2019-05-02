<?php

namespace EVB\OneHundred;

/**
 * A dice which has the ability to present data to be used for creating
 * a histogram.
 */
class HistogramDice extends Dice implements HistogramInterface
{
    use HistogramTrait;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get max value for the histogram.
     *
     * @return int with the max value.
     */
    public function getHistogramMax()
    {
        return $this->sides;
    }



    /**
     * Roll the dice, remember its value in the serie and return
     * its value.
     *
     * @return int the value of the rolled dice.
     */
    public function roll()
    {
        $roll = parent::roll();
        $this->serie[] = $roll;
        return $roll;
    }
}
