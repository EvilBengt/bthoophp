<?php

namespace EVB\OneHundred;

/**
 * Generating histogram data.
 */
class Histogram
{
    /**
     * @var array $serie  The numbers stored in sequence.
     * @var int   $min    The lowest possible number.
     * @var int   $max    The highest possible number.
     * @var HistogramInterface $subject The subject.
     */
    private $serie = [];
    private $min;
    private $max;
    private $subject;

    /**
     * Constructor
     */
    public function __construct(HistogramInterface $subject)
    {
        $this->subject = $subject;
        $this->min = $subject->getHistogramMin();
        $this->max = $subject->getHistogramMax();
    }

    /**
     * Get new data from subject.
     *
     * @return void
     */
    public function update()
    {
        $this->serie = $this->subject->getHistogramSerie();
    }

    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getSerie()
    {
        return $this->serie;
    }



    /**
     * Return a string with a textual representation of the histogram.
     *
     * @return string representing the histogram.
     */
    public function getAsText()
    {
        $min = $this->min;
        $max = $this->max;

        $values = [];

        for ($i=$min; $i <= $max; $i++) {
            $values[$i] = 0;
        }

        foreach ($this->serie as $value) {
            $values[$value]++;
        }

        $result = "";
        foreach ($values as $value => $frequency) {
            $result .= $value . ": " . \str_repeat("*", $frequency) . "\n";
        }
        return $result;
    }
}
