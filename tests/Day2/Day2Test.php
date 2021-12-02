<?php

namespace AoC\Tests\Day2;

use AoC\PuzzleSetup;
use PHPUnit\Framework\TestCase;

class Day2Test extends TestCase
{

    private static int $testCounter = 0;
    private PuzzleSetup $setup;

    private int $resultTest1 = 150;
    private int $resultTest2 = 900;

    public function __construct()
    {
        parent::__construct();

        $this->setup = new PuzzleSetup(2);
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
        $resultTest = $this->setup->day->getMultipliedValue($this->setup->getInputTest());
        $resultCalc = $this->setup->day->getMultipliedValue($this->setup->getInput());

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
        $resultTest = $this->setup->day->getMultipliedValueAdvanced($this->setup->getInputTest());
        $resultCalc = $this->setup->day->getMultipliedValueAdvanced($this->setup->getInput());

        $this->assertEquals($this->resultTest2, $resultTest);
        self::$testCounter++;

        if ($resultReal !== null) {
            $this->assertEquals($resultReal, $resultCalc);
            self::$testCounter++;
        }
    }

}
