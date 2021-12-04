<?php

namespace AoC\Day4;

class BingoBoard
{

    private array $rows;

    public function __construct(private string $name)
    {
    }

    public function addRow(BingoRow $row)
    {
        $this->rows[] = $row;
    }

    /**
     * @return array
     */
    public function getRows(): array
    {
        return $this->rows;
    }

    public function getColumnByIndex(int $index): array
    {
        $columnValues = array();

        /* @var $row BingoRow */
        foreach ($this->rows as $row) {
            $columnValues[] = $row->getNumbers()[$index];
        }

        return $columnValues;
    }

    public function countMarkedNumbersInColumn(array $columnValues): int
    {
        $marked = 0;
        /* @var $value BingoNumber */
        foreach ($columnValues as $number) {
            if ($number->getIsMarked()) {
                $marked++;
            }
        }

        return $marked;
    }

    public function getAllUnmarkedSum(): int
    {
        $unmarkedSum = 0;
        foreach ($this->rows as $rows) {
            foreach ($rows->getNumbers() as $number) {
                if (!$number->getIsMarked()) {
                    $unmarkedSum += $number->getNumber();
                }
            }
        }

        return $unmarkedSum;

    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }




}