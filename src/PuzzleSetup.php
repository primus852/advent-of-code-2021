<?php

namespace AoC;

use Exception;
use JetBrains\PhpStorm\Pure;

class PuzzleSetup
{

    public mixed $day;

    public function __construct(private int $noOfDay)
    {
        $class = 'AoC\Day' . $this->noOfDay . '\Day' . $this->noOfDay;
        $this->day = new $class();
    }

    #[Pure]
    public function getInput(): array
    {
        return $this->_readInput();
    }

    #[Pure]
    public function getInputTest(): array
    {
        return $this->_readInput(true);
    }

    #[Pure]
    public function getResults(): array
    {
        return $this->_readInput(false, true);
    }

    #[Pure]
    public function getResultByPart(int $part): ?int
    {
        $results = $this->getResults();

        if ($results) {
            if (array_key_exists($part - 1, $results)) {
                return (int)$results[$part - 1];
            }
        }

        return null;
    }

    private function _readInput(bool $isTest = false, bool $isResult = false): array
    {
        $file = $isTest ? 'values_test' : 'values';
        $file = $isResult ? 'results' : $file;

        try {
            $content = file_get_contents(__DIR__ . '\..\data\day' . $this->noOfDay . '\\' . $file . '.txt');
        } catch (Exception $e) {
            return array();
        }

        return explode("\n", $content);
    }

}