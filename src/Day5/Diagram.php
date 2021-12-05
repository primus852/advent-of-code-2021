<?php

namespace AoC\Day5;

class Diagram
{

    private array $spots = array();

    public function __construct(private int $minX, private int $minY, private int $maxX, private int $maxY)
    {
        $this->_setupDiagram();
    }

    private function _setupDiagram()
    {
        for ($x = $this->minX; $x <= $this->maxX; $x++) {
            for ($y = $this->minY; $y <= $this->maxY; $y++) {
                $this->spots[$x][$y] = 0;
            }
        }
    }

    /**
     * @return array
     */
    public function getSpots(): array
    {
        return $this->spots;
    }

    public function addToSpotByCoords(int $x, int $y)
    {
        $this->spots[$x][$y]++;
    }

    public function getSpotByCoords(int $x, int $y)
    {
        return $this->spots[$x][$y];
    }

}