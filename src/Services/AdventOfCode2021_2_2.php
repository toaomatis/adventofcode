<?php

namespace App\Services;

final class AdventOfCode2021_2_2 extends AbstractAdventOfCode
{
    /**
     * @param string $year
     * @param string $day
     * @return bool
     */
    public function solve(string $year, string $day): bool
    {
        /* This puzzle reuses the same input as 2_1 */
        $puzzleInput = $this->getPuzzleInput($year, '2_1');
        $this->logger->debug(sprintf('Found %d lines', count($puzzleInput)));
        $horizontalPosition = 0;
        $depth = 0;
        $aim = 0;
        foreach ($puzzleInput as $line) {
            $vector = explode(' ', trim($line));
            $direction = $vector[0];
            $value = (int)$vector[1];
            switch ($direction) {
                case 'forward':
                    $horizontalPosition += $value;
                    $depth += ($aim * $value);
                    break;
                case 'up':
                    $aim -= $value;
                    break;
                case 'down':
                    $aim += $value;
                    break;
                default:
                    throw new \InvalidArgumentException($line);
            }
        }
        $this->logger->info(sprintf('Found %d horizontal position', $horizontalPosition));
        $this->logger->info(sprintf('Found %d depth', $depth));
        $this->logger->info(sprintf('Found %d multiplied', $horizontalPosition * $depth));

        return true;
    }
}