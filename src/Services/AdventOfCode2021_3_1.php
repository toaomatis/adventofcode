<?php

namespace App\Services;

final class AdventOfCode2021_3_1 extends AbstractAdventOfCode
{
    /**
     * @param string $year
     * @param string $day
     * @return bool
     */
    public function solve(string $year, string $day): bool
    {
        $puzzleInput = $this->getPuzzleInput($year, $day);
        $this->logger->debug(sprintf('Found %d lines', count($puzzleInput)));
        $diagnosticReport = $this->toTwoDimensionalArrayAndTranspose($puzzleInput);
        $gammaRate = 0;
        $epsilonRate = 0;
        foreach ($diagnosticReport as $occurrences) {
            $gammaRate <<= 1;
            $epsilonRate <<= 1;
            if ($occurrences[0] > $occurrences[1]) {
                $epsilonRate += 1;
            } else {
                $gammaRate += 1;
            }
        }
        $this->logger->info(sprintf('Found %d gamma rate', $gammaRate));
        $this->logger->info(sprintf('Found %d epsilon rate', $epsilonRate));
        $this->logger->info(sprintf('Found %d multiplied', $gammaRate * $epsilonRate));

        return true;
    }

    /**
     * @param array<int, string> $lines
     * @return array<int, array<int, int>>
     */
    private function toTwoDimensionalArrayAndTranspose(array $lines): array
    {
        $output = [];
        foreach ($lines as $lineIndex => $line) {
            $characters = str_split($line);
            foreach ($characters as $characterIndex => $character) {
                $value = (int)$character;
                if (array_key_exists($characterIndex, $output) === false) {
                    $output[$characterIndex] = [
                        0 => 0,
                        1 => 0,
                    ];
                }
                $output[$characterIndex][$value] = $output[$characterIndex][$value] + 1;
            }
        }

        return $output;
    }
}