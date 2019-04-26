<?php

namespace EVB\OneHundred;

use PHPUnit\Framework\TestCase;

require_once "Mocking/OneSidedDiceFactory.php";
require_once "Mocking/AnswerToLifeDiceFactory.php";
require_once "Mocking/AnswerToLifeDice.php";

/**
 * Test class for DiceHand, normal operation.
 */
class DiceHandTests extends TestCase
{
    /**
     * Test constructor.
     */
    public function testConstructor()
    {
        $diceHand = new NormalDiceHand(1, new NormalDiceFactory());

        $this->assertInstanceOf(NormalDiceHand::class, $diceHand);
    }

    /**
     * Test roll rolls 2 dices,
     * results should be available
     * with values().
     */
    public function testRollAndValues()
    {
        $diceHand = new NormalDiceHand(2, new NormalDiceFactory);

        $diceHand->roll();

        $result = $diceHand->values();

        $this->assertCount(2, $result);
    }

    /**
     * Test hasOnes returns true if
     * values contains one or more ones.
     */
    public function testHasOnesTrue()
    {
        $diceHand = new NormalDiceHand(1, new OneSidedDiceFactory());

        $diceHand->roll();

        $result = $diceHand->hasOnes();

        $this->assertTrue($result);
    }

    /**
     * Test hasOnes returns true if
     * values contains one or more ones.
     */
    public function testHasOnesFalse()
    {
        $diceHand = new NormalDiceHand(1, new AnswerToLifeDiceFactory());

        $diceHand->roll();

        $result = $diceHand->hasOnes();

        $this->assertFalse($result);
    }

    /**
     * Test sum returns sum of last rolls.
     */
    public function testSum()
    {
        $diceHand = new NormalDiceHand(1, new AnswerToLifeDiceFactory());

        $diceHand->roll();

        $result = $diceHand->sum();

        $this->assertEquals(42, $result);
    }
}
