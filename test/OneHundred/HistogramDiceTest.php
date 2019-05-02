<?php

namespace EVB\OneHundred;

use PHPUnit\Framework\TestCase;

/**
 * Test class for Dice, normal operation.
 */
class HistogramDiceTests extends TestCase
{
    /**
     * Test constructor.
     */
    public function testConstructor()
    {
        $dice = new HistogramDice();

        $this->assertInstanceOf(HistogramDice::class, $dice);
    }

    /**
     * Test that roll returns an integer.
     */
    public function testRollInteger()
    {
        $dice = new HistogramDice();

        $result = $dice->roll();

        $this->assertIsInt($result);
    }
}
