<?php

namespace AoC\Tests\Day1;

use AoC\PuzzleSetup;
use PHPUnit\Framework\TestCase;

class Day1Test extends TestCase
{
    private static int $testCounter = 0;
    private PuzzleSetup $setup;

    private int $resultTest1 = 7;
    private int $resultTest2 = 5;

    public function __construct()
    {
        parent::__construct();

        $this->setup = new PuzzleSetup(1);
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
        $resultTest = $this->setup->day->getIncreases($this->setup->getInputTest());
        $resultCalc = $this->setup->day->getIncreases($this->setup->getInput());

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
        $resultTest = $this->setup->day->getIncreasesAdvanced($this->setup->getInputTest());
        $resultCalc = $this->setup->day->getIncreasesAdvanced($this->setup->getInput());

        $this->assertEquals($this->resultTest2, $resultTest);
        self::$testCounter++;

        if ($resultReal !== null) {
            $this->assertEquals($resultReal, $resultCalc);
            self::$testCounter++;
        }
    }
}
