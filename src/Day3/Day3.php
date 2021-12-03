<?php

namespace AoC\Day3;

class Day3
{

    public function getPowerConsumption(array $lines)
    {

        $powerConsumption = new PowerConsumption();

        foreach ($lines as $line) {
            $split = str_split($line);

            foreach ($split as $pos => $value) {
                $powerConsumption->addToColumn($pos, $value);
            }
        }

        try {
            $summary = $powerConsumption->summarizeColumns();
        } catch (\Exception $e) {
            print($e->getMessage());
            exit();
        }

        return $summary['gamma']['asDecimal'] * $summary['epsilon']['asDecimal'];

    }

    public function getLifeSupportRating(array $lines)
    {

        $powerConsumption = new PowerConsumption();
        $oxygenRating = $powerConsumption->oxygenGeneratorRatingAsDecimal($lines);
        $scrubberRating = $powerConsumption->scrubberRatingAsDecimal($lines);


        return $oxygenRating * $scrubberRating;


    }

}