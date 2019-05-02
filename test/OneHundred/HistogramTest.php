<?php

namespace EVB\OneHundred;

use PHPUnit\Framework\TestCase;

require_once "Mocking/SimplePlayer.php";
require_once "Mocking/UnfortunatePlayer.php";

/**
 * Test class for Histogram, normal operation.
 */
class HistogramTest extends TestCase
{
    /**
     * @var Histogram
     */
    private $sut;

    /**
     * @var HistogramDice
     */
    private $dice;

    public function setUp()
    {
        $this->dice = new HistogramDice();
        $this->sut = new Histogram($this->dice);

        $this->dice->roll();
        $this->sut->update();
    }

    public function testUpdateAndGetSerie()
    {
        $result = $this->sut->getSerie();

        $this->assertIsArray($result);
    }

    public function testGetAsTextReturnsString()
    {
        $result = $this->sut->getAsText();

        $this->assertIsString($result);
        $this->assertStringStartsWith("1", $result);
    }
}
