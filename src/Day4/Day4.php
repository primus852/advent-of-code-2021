<?php

namespace AoC\Day4;

class Day4
{

    private int $lastNumber;
    private int $winningSum;
    private int $loosingSum;

    public function getWinnerBoard(array $lines): int
    {

        /**
         * Take the first line as $numbersPicked
         */
        $numbersPicked = explode(',', $lines[0]);

        /**
         * Set up the game
         */
        $game = $this->_preSetup($lines);

        /**
         * Get the Winning Board (and set the needed numbers
         */
        $this->_getWinningBoard($game, $numbersPicked);

        /**
         * Return the result
         */
        return $this->lastNumber * $this->winningSum;
    }

    public function getLooserBoard(array $lines): int
    {
        /**
         * Take the first line as $numbersPicked
         */
        $numbersPicked = explode(',', $lines[0]);

        /**
         * Set up the game
         */
        $game = $this->_preSetup($lines);

        /**
         * Get the Winning Board (and set the needed numbers
         */
        $this->_getLastWinningBoard($game, $numbersPicked);

        /**
         * Return the result
         */
        return $this->lastNumber * $this->loosingSum;
    }

    private function _getLastWinningBoard(Game $game, array $numbersPicked)
    {

        /**
         * Go through all numbers
         */
        $allSolved = false;
        $winningBoards = array();
        $winners = 0;
        foreach ($numbersPicked as $value) {

            if ($allSolved) {
                break;
            }

            $numberPicked = str_replace("\r", "", $value);

            /**
             * Check all Boards for that number and mark the number
             */
            foreach ($game->getBoards() as $board) {
                foreach ($board->getRows() as $row) {
                    foreach ($row->getNumbers() as $number) {
                        if ((int)$numberPicked === $number->getNumber()) {
                            $number->setIsMarked();
                        }
                    }
                }
            }

            /**
             * Check if one Board has won
             */
            foreach ($game->getBoards() as $board) {

                /**
                 * Check if a row is completed
                 */
                $tempNumberCount = 0;
                $isWinner = false;
                foreach ($board->getRows() as $row) {
                    $tempNumberCount = count($row->getNumbers());
                    if ($row->countMarkedNumbersInRow() === $tempNumberCount) {
                        if (!array_key_exists($board->getName(), $winningBoards)) {
                            $winningBoards[$board->getName()] = $board;
                            $winners++;
                            $isWinner = true;
                            if ($winners === $game->countBoards()) {
                                $this->loosingSum = $board->getAllUnmarkedSum();
                                $this->lastNumber = (int)$numberPicked;
                                $allSolved = true;
                                break;
                            }
                        }
                    }
                }

                /**
                 * Check if a column is completed
                 */
                if (!$isWinner) {
                    for ($x = 0; $x < $tempNumberCount; $x++) {
                        $column = $board->getColumnByIndex($x);
                        if ($board->countMarkedNumbersInColumn($column) === $tempNumberCount) {
                            if (!array_key_exists($board->getName(), $winningBoards)) {
                                $winningBoards[$board->getName()] = $board;
                                $winners++;
                                if ($winners === $game->countBoards()) {
                                    $this->loosingSum = $board->getAllUnmarkedSum();
                                    $this->lastNumber = (int)$numberPicked;
                                    $allSolved = true;
                                    break;
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    private function _getWinningBoard(Game $game, array $numbersPicked)
    {

        /**
         * "Draw" the next number
         */
        foreach ($numbersPicked as $value) {

            $numberPicked = str_replace("\r", "", $value);

            /**
             * Check all Boards for that number and mark the number
             */
            foreach ($game->getBoards() as $board) {
                foreach ($board->getRows() as $row) {
                    foreach ($row->getNumbers() as $number) {
                        if ((int)$numberPicked === $number->getNumber()) {
                            $number->setIsMarked();
                        }
                    }
                }
            }

            /**
             * Check if one Board has won
             */
            foreach ($game->getBoards() as $board) {

                /**
                 * Check if a row is completed
                 */
                $tempNumberCount = 0;
                foreach ($board->getRows() as $row) {
                    $tempNumberCount = count($row->getNumbers());
                    if ($row->countMarkedNumbersInRow() === $tempNumberCount) {
                        $this->winningSum = $board->getAllUnmarkedSum();
                        $this->lastNumber = $numberPicked;
                        break 3;
                    }
                }

                /**
                 * Check if a column is completed
                 */
                for ($x = 0; $x < $tempNumberCount; $x++) {
                    $column = $board->getColumnByIndex($x);
                    if ($board->countMarkedNumbersInColumn($column) === $tempNumberCount) {
                        $this->winningSum = $board->getAllUnmarkedSum();
                        $this->lastNumber = $numberPicked;
                        break 3;
                    }
                }
            }
        }
    }

    private function _preSetup(array $lines): Game
    {

        /**
         * Remove the first two rows and start instantiating the Boards
         */
        $lines = array_slice($lines, 2);

        /**
         * Set up the Game with all its Boards
         */
        return $this->_setupGame($lines);
    }

    private function _setupGame(array $lines): Game
    {
        /**
         * Create a new Game to hold all Boards
         */
        $game = new Game();

        /**
         * Loop through the remains and create the Boards
         */
        $board = null;
        $i = 0;
        $boardCount = 1;
        foreach ($lines as $line) {

            /**
             * Replace the \r char
             */
            $line = str_replace("\r", "", $line);

            /**
             * Skip empty lines
             */
            if ($line === "") {
                continue;
            }

            /**
             * If it's the first row of the board, create a new Board
             */
            if (($i % 5) === 0 || $i === 0) {
                $board = new BingoBoard($boardCount);
                $game->addBoard($board);
                $boardCount++;
            }

            /**
             * Get the picked numbers individually
             */
            $picks = explode(" ", $line);

            /**
             * Add row to the Board
             */
            $row = new BingoRow();
            $board->addRow($row);

            foreach ($picks as $pick) {
                /**
                 * If line
                 */
                if ($pick === "") {
                    continue;
                }
                $bingoNumber = new BingoNumber((int)$pick);
                $row->addPick($bingoNumber);
            }

            $i++;
        }

        return $game;
    }

}