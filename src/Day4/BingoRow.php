<?php

namespace AoC\Day4;

class BingoRow
{

    private array $numbers;

    public function addPick(BingoNumber $number)
    {
        $this->numbers[] = $number;
    }

    /**
     * @return array
     */
    public function getNumbers(): array
    {
        return $this->numbers;
    }

    public function countMarkedNumbersInRow(): int
    {
        $marked = 0;

        foreach ($this->numbers as $number) {
            if ($number->getIsMarked()) {
                $marked++;
            }
        }

        return $marked;

    }


}