<?php

namespace AoC\Day3;

use Exception;
use JetBrains\PhpStorm\ArrayShape;

class PowerConsumption
{

    private array $columns = array();

    public function addToColumn(int $col, string $value): void
    {
        if (!array_key_exists($col, $this->columns)) {
            $this->columns[$col] = array(
                'ones' => 0,
                'zeroes' => 0
            );
        }

        $this->columns[$col][$value === '1' ? 'ones' : 'zeroes']++;
    }

    /**
     * @return array
     * @throws Exception
     */
    #[ArrayShape(['gamma' => "array", 'epsilon' => "array"])]
    public function summarizeColumns(): array
    {

        $gammaString = '';
        $epsilonString = '';

        for ($i = 0; $i < count($this->columns) - 1; $i++) {
            for ($i = 0; $i < count($this->columns) - 1; $i++) {
                $gammaString .= $this->_mostByColumnIndex($this->columns, $i, '');
                $epsilonString .= $this->_leastByColumnIndex($this->columns, $i, '');
            }
        }

        return array(
            'gamma' => array(
                'asString' => $gammaString,
                'asDecimal' => bindec($gammaString)
            ),
            'epsilon' => array(
                'asString' => $epsilonString,
                'asDecimal' => bindec($epsilonString)
            )
        );

    }

    public function scrubberRatingAsDecimal(array $lines, int $startIndex = 0): int
    {

        if (count($lines) === 1) {
            return bindec(str_replace("\r", "", $lines[0]));
        }

        /**
         * Find the least common in $startIndex
         */
        $leastCommonAtStartIndex = $this->_getLeastByLines($lines, $startIndex, '0');

        /**
         * Move all values with LEAST COMMON at STARTINDEX
         */
        $reducedLines = array();
        foreach ($lines as $line) {

            /**
             * Explode the value to check the string at position $startIndex
             */
            $split = str_split($line);

            if ($split[$startIndex] === $leastCommonAtStartIndex) {
                $reducedLines[] = $line;
            }
        }

        $startIndex++;

        return $this->scrubberRatingAsDecimal($reducedLines, $startIndex);
    }

    public function oxygenGeneratorRatingAsDecimal(array $lines, int $startIndex = 0): int
    {
        if (count($lines) === 1) {
            return bindec(str_replace("\r", "", $lines[0]));
        }

        /**
         * Find the most common in $startIndex
         */
        $mostCommonAtStartIndex = $this->_getMostByLines($lines, $startIndex, '1');

        /**
         * Move all values with MOSTCOMMON at STARTINDEX
         */
        $reducedLines = array();
        foreach ($lines as $line) {

            /**
             * Explode the value to check the string at position $startIndex
             */
            $split = str_split($line);

            if ($split[$startIndex] === $mostCommonAtStartIndex) {
                $reducedLines[] = $line;
            }
        }

        $startIndex++;

        return $this->oxygenGeneratorRatingAsDecimal($reducedLines, $startIndex);

    }

    private function _getMostByLines(array $lines, int $charIndex, string $keepOnEqual)
    {

        $zeroes = 0;
        $ones = 0;

        foreach ($lines as $line) {

            $split = str_split($line);

            if ($split[$charIndex] === '1') {
                $ones++;
            } else {
                $zeroes++;
            }
        }

        return match (true) {
            $zeroes > $ones => '0',
            $ones > $zeroes => '1',
            $ones === $zeroes => $keepOnEqual,
        };

    }

    private function _getLeastByLines(array $lines, int $charIndex, string $keepOnEqual)
    {

        $zeroes = 0;
        $ones = 0;

        foreach ($lines as $line) {

            $split = str_split($line);

            if ($split[$charIndex] === '1') {
                $ones++;
            } else {
                $zeroes++;
            }
        }

        return match (true) {
            $zeroes > $ones => '1',
            $ones > $zeroes => '0',
            $ones === $zeroes => $keepOnEqual,
        };

    }

    /**
     * @param int $index
     * @return string
     * @throws Exception
     */
    private function _mostByColumnIndex(array $columns, int $index, string $keepOnEqual): string
    {

        try {
            $zeroes = $columns[$index]['zeroes'];
            $ones = $columns[$index]['ones'];
        } catch (Exception $e) {
            throw new Exception('INVALID_INDEX_' . $index);
        }

        return match (true) {
            $zeroes > $ones => '0',
            $ones > $zeroes => '1',
            $ones === $zeroes => $keepOnEqual,
        };
    }

    /**
     * @param int $index
     * @return string
     * @throws Exception
     */
    private function _leastByColumnIndex(array $columns, int $index, string $keepOnEqual): string
    {

        try {
            $zeroes = $columns[$index]['zeroes'];
            $ones = $columns[$index]['ones'];
        } catch (Exception $e) {
            throw new Exception('INVALID_INDEX_' . $index);
        }

        return match (true) {
            $zeroes > $ones => '1',
            $ones > $zeroes => '0',
            $ones === $zeroes => $keepOnEqual,
        };
    }

}