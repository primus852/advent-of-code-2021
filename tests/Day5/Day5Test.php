<?php

namespace AoC\Tests\Day5;

use AoC\Day5\Day5;
use AoC\PuzzleSetup;
use PHPUnit\Framework\TestCase;

class Day5Test extends TestCase
{

    private static int $testCounter = 0;
    private PuzzleSetup $setup;

    private int $resultTest1 = 5;
    private int $resultTest2 = 12;

    public function __construct()
    {
        parent::__construct();

        $this->setup = new PuzzleSetup(5);
    }

    public static function tearDownAfterClass(): void
    {
        if (self::$testCounter < 4) {
            print('MISSING RESULT VALUES');
        }
    }

    public function testPart1()
    {
        $resultReal = $this->setup->getResultByPart(1);
        $resultTest = $this->setup->day->getOverlappingCount($this->setup->getInputTest());
        $resultCalc = $this->setup->day->getOverlappingCount($this->setup->getInput());

        $this->assertEquals($this->resultTest1, $resultTest);
        self::$testCounter++;

        if ($resultReal !== null) {
            $this->assertEquals($resultReal, $resultCalc);
            self::$testCounter++;
        }
    }

    public function testPart2()
    {
        $resultReal = $this->setup->getResultByPart(2);
        $resultTest = $this->setup->day->getOverlappingCountDiagonal($this->setup->getInputTest());
        //$resultCalc = $this->setup->day->getOverlappingCountDiagonal($this->setup->getInput());

        $this->assertEquals($this->resultTest1, $resultTest);
        self::$testCounter++;

//        if ($resultReal !== null) {
//            $this->assertEquals($resultReal, $resultCalc);
//            self::$testCounter++;
//        }
    }

}
