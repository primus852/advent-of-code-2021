<?php

namespace AoC\Day2;

class Day2
{

    public function getMultipliedValue(array $values): int
    {
        $horizontal = 0;
        $depth = 0;

        foreach ($values as $value) {

            $cols = explode(" ", $value);

            switch ($cols[0]) {
                case 'forward':
                    $horizontal += (int)$cols[1];
                    break;
                case 'down':
                    $depth += (int)$cols[1];
                    break;
                case 'up':
                    $depth -= (int)$cols[1];
                    break;
            }
        }

        return $horizontal * $depth;

    }

    public function getMultipliedValueAdvanced(array $values): int
    {

        $horizontal = 0;
        $depth = 0;
        $aim = 0;

        foreach ($values as $value) {

            $cols = explode(" ", $value);

            switch ($cols[0]) {
                case 'forward':
                    $horizontal += (int)$cols[1];
                    $depth += $aim * (int)$cols[1];
                    break;
                case 'down':
                    $aim += (int)$cols[1];
                    break;
                case 'up':
                    $aim -= (int)$cols[1];
                    break;
            }
        }

        return $horizontal * $depth;

    }

}