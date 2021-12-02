<?php

namespace AoC\Day1;

class SlidingWindow
{
    private int $totalValue = 0;


    public function __construct()
    {
    }

    public function addValue(int $value)
    {
        $this->totalValue += $value;
    }

    public function getTotalValue(): int
    {
        return $this->totalValue;
    }

}