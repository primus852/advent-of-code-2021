<?php

namespace AoC\Day5;

use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

class Day5
{

    public function getOverlappingCount(array $lines): int
    {
        /**
         * Set up the Diagram
         */
        $diagram = $this->_createDiagram($lines);

        /**
         * Mark the Spots that were accessed
         */
        $this->_markSpotsOnlyVerticalAndHorizontal($lines, $diagram);

        /**
         * Count the dangerous spots
         */
        return $this->_countSpots($diagram);

    }

    public function getOverlappingCountDiagonal(array $lines): int
    {
        /**
         * Set up the Diagram
         */
        $diagram = $this->_createDiagram($lines);

        /**
         * Mark the Spots that were accessed
         */
        $this->_markSpotsDiagonal($lines, $diagram);

        /**
         * Count the dangerous spots
         */
        return $this->_countSpots($diagram);

    }

    private function _markSpotsDiagonal(array $lines, Diagram $diagram)
    {
        foreach ($lines as $line) {

            $coords = $this->_getCoords($line);

            /**
             * Make the way on X
             */
            $tempHits = array();

            print("FROM ".$coords['x1'].",".$coords['y1']. " TO ".$coords['y1'].",".$coords['y2']."\n");

            if ($coords['x1'] !== $coords['x2'] && $coords["y1"] !== $coords["y2"]) {

                print("DIAGONAL!\n");

                /**
                 * Case one: bottom right to top left - 8,0 -> 0,8
                 */

                /**
                 * Case two: top right to bottom left - 6,4 -> 2,0
                 */

                /**
                 * Case three: bottom left to top right - 0,0 -> 0,8
                 */

                /**
                 * Case one: top left to bottom right - 0,8 -> 3,5
                 */

                // CONTINUE HERE

            }else{

                print("STRAIGHT!\n");

                if ($coords['x1'] < $coords['x2']) {
                    for ($x = $coords['x1']; $x <= $coords['x2']; $x++) {
                        if (!in_array($x . "," . $coords["y1"], $tempHits)) {
                            $diagram->addToSpotByCoords($x, $coords["y1"]);
                            $tempHits[] = $x . "," . $coords["y1"];
                        }
                    }
                } else {
                    for ($x = $coords['x1']; $x >= $coords['x2']; $x--) {
                        if (!in_array($x . "," . $coords["y1"], $tempHits)) {
                            $diagram->addToSpotByCoords($x, $coords["y1"]);
                            $tempHits[] = $x . "," . $coords["y1"];
                        }
                    }
                }

                /**
                 * Make the way to Y
                 * do not double hit what we just hit (start and end)
                 */
                if ($coords['y1'] < $coords['y2']) {
                    for ($y = $coords['y1']; $y <= $coords['y2']; $y++) {
                        if (!in_array($coords["x1"] . "," . $y, $tempHits)) {
                            $diagram->addToSpotByCoords($coords["x1"], $y);
                        }
                    }
                } else {
                    for ($y = $coords['y1']; $y >= $coords['y2']; $y--) {
                        if (!in_array($coords["x1"] . "," . $y, $tempHits)) {
                            $diagram->addToSpotByCoords($coords["x1"], $y);
                        }
                    }
                }


                for ($x = $coords['x1']; $x <= $coords['x2']; ++$x) {
                    for ($y = $coords['y1']; $y <= $coords['y2']; ++$y) {
                        if (!in_array($x . "," . $y, $tempHits)) {
                            $diagram->addToSpotByCoords($x, $y);
                            print("HIT ".$x.",".$y."\n");
                            $tempHits[] = $x . "," . $y;
                        }
                    }
                }
            }
        }
    }

    #[Pure]
    private function _countSpots(Diagram $diagram): int
    {
        $dangers = 0;
        foreach ($diagram->getSpots() as $spots) {
            foreach ($spots as $value) {
                if ($value >= 2) {
                    $dangers++;
                }
            }
        }

        return $dangers;

    }

    private function _markSpotsOnlyVerticalAndHorizontal(array $lines, Diagram $diagram)
    {

        foreach ($lines as $line) {

            $coords = $this->_getCoords($line);

            /**
             * Make the way on X
             */
            $tempHits = array();

            /**
             * Skip lines where $x1 != $x2 and $y1 != $y2
             */
            if ($coords['x1'] !== $coords['x2'] && $coords["y1"] !== $coords["y2"]) {
                continue;
            }


            if ($coords['x1'] < $coords['x2']) {
                for ($x = $coords['x1']; $x <= $coords['x2']; $x++) {
                    if (!in_array($x . "," . $coords["y1"], $tempHits)) {
                        $diagram->addToSpotByCoords($x, $coords["y1"]);
                        $tempHits[] = $x . "," . $coords["y1"];
                    }
                }
            } else {
                for ($x = $coords['x1']; $x >= $coords['x2']; $x--) {
                    if (!in_array($x . "," . $coords["y1"], $tempHits)) {
                        $diagram->addToSpotByCoords($x, $coords["y1"]);
                        $tempHits[] = $x . "," . $coords["y1"];
                    }
                }
            }

            /**
             * Make the way to Y
             * do not double hit what we just hit (start and end)
             */
            if ($coords['y1'] < $coords['y2']) {
                for ($y = $coords['y1']; $y <= $coords['y2']; $y++) {
                    if (!in_array($coords["x1"] . "," . $y, $tempHits)) {
                        $diagram->addToSpotByCoords($coords["x1"], $y);
                    }
                }
            } else {
                for ($y = $coords['y1']; $y >= $coords['y2']; $y--) {
                    if (!in_array($coords["x1"] . "," . $y, $tempHits)) {
                        $diagram->addToSpotByCoords($coords["x1"], $y);
                    }
                }
            }
        }
    }

    private function _createDiagram(array $lines): Diagram
    {

        /**
         * Get the size
         */
        $maxX1 = 0;
        $maxY1 = 0;
        $maxX2 = 0;
        $maxY2 = 0;

        $minX1 = 0;
        $minY1 = 0;
        $minX2 = 0;
        $minY2 = 0;
        foreach ($lines as $line) {

            $coords = $this->_getCoords($line);

            /**
             * Assign if bigger/smaller than previous Values
             */
            if ($coords['x1'] > $maxX1) {
                $maxX1 = $coords['x1'];
            }

            if ($coords['x1'] < $minX1) {
                $minX1 = $coords['x1'];
            }

            if ($coords['x2'] > $maxX2) {
                $maxX2 = $coords['x2'];
            }

            if ($coords['x2'] < $minX2) {
                $minX2 = $coords['x2'];
            }

            if ($coords['y1'] > $maxY1) {
                $maxY1 = $coords['y1'];
            }

            if ($coords['y1'] < $minY1) {
                $minY1 = $coords['y1'];
            }

            if ($coords['y2'] > $maxY2) {
                $maxY2 = $coords['y2'];
            }

            if ($coords['y2'] < $minY2) {
                $minY2 = $coords['y2'];
            }

        }

        $maxX = max($maxX1, $maxX2);
        $maxY = max($maxY1, $maxY2);

        $minX = min($minX1, $minX2);
        $minY = min($minY1, $minY2);

        return new Diagram($minX, $minY, $maxX, $maxY);

    }

    #[ArrayShape(['x1' => "int", 'y1' => "int", 'x2' => "int", 'y2' => "int"])]
    private function _getCoords(string $line): array
    {
        $value = str_replace("\r", "", $line);

        /**
         * Split by " -> "
         */
        $coords = explode(" -> ", $value);

        /**
         * Split both by ","
         */
        $coordsLeft = explode(",", $coords[0]);
        $coordsRight = explode(",", $coords[1]);

        /**
         * Clarification
         */
        $x1 = (int)$coordsLeft[0];
        $y1 = (int)$coordsLeft[1];
        $x2 = (int)$coordsRight[0];
        $y2 = (int)$coordsRight[1];

        return array(
            'x1' => $x1,
            'y1' => $y1,
            'x2' => $x2,
            'y2' => $y2,
        );
    }

}