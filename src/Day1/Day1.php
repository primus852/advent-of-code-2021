<?php

namespace AoC\Day1;

class Day1
{

    public function getIncreases(array $values): int
    {

        $lastValue = null;
        $increased = 0;
        foreach ($values as $value) {

            if ($lastValue === null) {
                $lastValue = (int)$value;
                continue;
            }

            $currentValue = (int)$value;

            if ($currentValue > $lastValue) {
                $increased++;
            }
            $lastValue = $currentValue;
        }

        return $increased;

    }

    public function getIncreasesAdvanced(array $lines): int
    {

        $slidingWindowsIndex = 0;
        $slidingWindows = array();
        foreach ($lines as $i => $line) {

            if (!array_key_exists($slidingWindowsIndex, $slidingWindows)) {

                /**
                 * Create new Sliding Window
                 */
                $slidingWindows[$slidingWindowsIndex] = new SlidingWindow();
                $slidingWindows[$slidingWindowsIndex]->addValue($line);

                /**
                 * Add next to values if they exist
                 */
                if (array_key_exists(($i + 1), $lines)) {
                    $slidingWindows[$slidingWindowsIndex]->addValue($lines[$i + 1]);
                }

                if (array_key_exists(($i + 2), $lines)) {
                    $slidingWindows[$slidingWindowsIndex]->addValue($lines[$i + 2]);
                }

                $slidingWindowsIndex++;
            }
        }

        $values = array();
        foreach ($slidingWindows as $slidingWindow) {
            $values[] = $slidingWindow->getTotalValue();
        }


        return $this->getIncreases($values);
    }

}