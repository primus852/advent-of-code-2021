<?php

namespace AoC\Day4;

class Game
{
    private array $boards;

    public function addBoard(BingoBoard $board)
    {
        $this->boards[] = $board;
    }

    public function getBoards(): array
    {
        return $this->boards;
    }

    public function getBoardByIndex(int $index)
    {
        return $this->boards[$index];
    }

    public function countBoards(): int
    {
        return count($this->boards);
    }


}