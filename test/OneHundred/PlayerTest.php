<?php

namespace EVB\OneHundred;

use PHPUnit\Framework\TestCase;

require_once "Mocking/OneSidedDiceHand.php";
require_once "Mocking/AnswerToLifeDiceHand.php";

/**
 * Test class for Player, normal operation.
 */
class PlayerTests extends TestCase
{
    /**
     * Test constructor.
     */
    public function testConstructor()
    {
        $player = new NormalPlayer(new OneSidedDiceHand());

        $this->assertInstanceOf(NormalPlayer::class, $player);
    }

    /**
     * Test roll() and getLastRoll()
     * with 1-sided dice.
     */
    public function testLastRollOne()
    {
        $player = new NormalPlayer(new OneSidedDiceHand());

        $player->roll();

        $result = $player->getLastRoll();

        $this->assertEquals([1], $result);
    }

    /**
     * Test roll() and getLastRoll()
     * with dice only returning 42.
     */
    public function testLastRoll42()
    {
        $player = new NormalPlayer(new AnswerToLifeDiceHand());

        $player->roll();

        $result = $player->getLastRoll();

        $this->assertEquals([42], $result);
    }

    /**
     * Test getTempScore() when no ones are rolled.
     */
    public function testTempScore()
    {
        $player = new NormalPlayer(new AnswerToLifeDiceHand());

        $player->roll();

        $result = $player->getTempScore();

        $this->assertEquals(42, $result);
    }

    /**
     * Test getTempScore() when ones ARE rolled.
     */
    public function testTempScoreOnes()
    {
        $player = new NormalPlayer(new OneSidedDiceHand());

        $player->roll();

        $result = $player->getTempScore();

        $this->assertEquals(0, $result);
    }

    /**
     * Test rolledOnes() when no ones are rolled.
     */
    public function testRolledOnesFalse()
    {
        $player = new NormalPlayer(new AnswerToLifeDiceHand());

        $player->roll();

        $result = $player->rolledOnes();

        $this->assertFalse($result);
    }

    /**
     * Test rolledOnes() when ones ARE rolled.
     */
    public function testRolledOnesTrue()
    {
        $player = new NormalPlayer(new OneSidedDiceHand());

        $player->roll();

        $result = $player->rolledOnes();

        $this->assertTrue($result);
    }

    /**
     * Test save() and getTotalScore().
     */
    public function testSaveAndTotalScore()
    {
        $player = new NormalPlayer(new AnswerToLifeDiceHand());

        $player->roll();
        $player->save();

        $total = $player->getTotalScore();
        $temp = $player->getTempScore();

        $this->assertEquals(42, $total);
        $this->assertEquals(0, $temp);
    }
}
