<?php

namespace EVB\OneHundred;

use PHPUnit\Framework\TestCase;

/**
 * Test class for Dice, normal operation.
 */
class DiceTests extends TestCase
{
    /**
     * Test constructor.
     */
    public function testConstructor()
    {
        $dice = new Dice();

        $this->assertInstanceOf(Dice::class, $dice);
    }

    /**
     * Test that roll returns an integer.
     */
    public function testRollInteger()
    {
        $dice = new Dice();

        $result = $dice->roll();

        $this->assertIsInt($result);
    }
}
