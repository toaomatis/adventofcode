<?php

namespace App\Services;

final class AdventOfCode2021_2_1 extends AbstractAdventOfCode
{
    /**
     * @param string $year
     * @param string $day
     * @return bool
     */
    public function solve(string $year, string $day): bool
    {
        $puzzleInput = $this->getPuzzleInput($year, $day);
        $horizontalPosition = 0;
        $depth = 0;
        foreach ($puzzleInput as $line) {
            $vector = explode(' ', trim($line));
            $direction = $vector[0];
            $value = (int)$vector[1];
            switch ($direction) {
                case 'forward':
                    $horizontalPosition += $value;
                    break;
                case 'up':
                    $depth -= $value;
                    break;
                case 'down':
                    $depth += $value;
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