<?php

namespace EVB\OneHundred;

use PHPUnit\Framework\TestCase;

require_once "Mocking/SimplePlayer.php";
require_once "Mocking/UnfortunatePlayer.php";

/**
 * Test class for Game, normal operation.
 */
class GameTest extends TestCase
{
    /**
     * @var Game
     */
    private $game;

    public function setUp()
    {
        $this->game = new Game(
            new SimplePlayer(),
            new SimplePlayer(),
            1
        );
    }

    /**
     * Test constructor.
     */
    public function testConstructor()
    {

        $this->assertInstanceOf(Game::class, $this->game);
    }

    /**
     * Test rollPlayer() and getLastRoll().
     */
    public function testRollPlayerAndLastRoll()
    {
        $this->game->rollPlayer();

        $result = $this->game->getLastRoll();

        $this->assertEquals([101], $result);
    }

    /**
     * Test playerRolledOnes().
     */
    public function testPlayerRolledOnes()
    {
        $this->game->rollPlayer();

        $result = $this->game->playerRolledOnes();

        $this->assertFalse($result);
    }

    /**
     * Test getPlayerTempScore().
     */
    public function testPlayerTempScore()
    {
        $this->game->rollPlayer();

        $result = $this->game->getPlayerTempScore();

        $this->assertEquals(101, $result);
    }

    /**
     * Test getPlayerTotalScore() and savePlayer().
     */
    public function testPlayerTotalScore()
    {
        $this->game->rollPlayer();
        $this->game->savePlayer();

        $result = $this->game->getPlayerTotalScore();

        $this->assertEquals(101, $result);
    }

    /**
     * Test getComputerTotalScore() and
     * playComputer().
     */
    public function testComputerTotalScore()
    {
        $this->game->playComputer();

        $result = $this->game->getComputerTotalScore();

        $this->assertEquals(101, $result);
    }

    /**
     * Test playComputer() and
     * getComputerResults.
     */
    public function testPlayComputer()
    {
        $game = new Game(
            new UnfortunatePlayer(),
            new UnfortunatePlayer(),
            1
        );

        $game->playComputer();

        $result = $game->getComputerResults();

        $this->assertIsString($result);
    }

    /**
     * Test getWinner() when the player wins.
     */
    public function testGetWinnerDu()
    {
        $game = new Game(
            new SimplePlayer(),
            new UnfortunatePlayer(),
            1
        );

        $game->rollPlayer();
        $game->savePlayer();

        $result = $game->getWinner();

        $this->assertEquals("Du", $result);
    }
}
