<?php

namespace AoC\Day4;

class BingoNumber
{
    private bool $isMarked;

    public function __construct(private int $number)
    {
        $this->isMarked = false;
    }

    public function setIsMarked()
    {
        $this->isMarked = true;
    }

    public function getIsMarked(): bool
    {
        return $this->isMarked;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

}