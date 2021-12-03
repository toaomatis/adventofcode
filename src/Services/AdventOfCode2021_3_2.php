<?php

namespace App\Services;

final class AdventOfCode2021_3_2 extends AbstractAdventOfCode
{
    /**
     * @param string $year
     * @param string $day
     * @return int
     */
    public function solve(string $year, string $day): int
    {
        $puzzleInput = $this->getPuzzleInput($year, '3_1');
        $diagnosticReport = $this->getBitOccurrences($puzzleInput);
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

        return $gammaRate * $epsilonRate;
    }

    /**
     * @param array<int, string> $lines
     * @return array<int, array<int, int>>
     */
    private function getBitOccurrences(array $lines): array
    {
        $bitOccurrences = [];
        foreach ($lines as $line) {
            $characters = str_split($line);
            foreach ($characters as $characterIndex => $character) {
                $value = (int)$character;
                if (array_key_exists($characterIndex, $bitOccurrences) === false) {
                    $bitOccurrences[$characterIndex] = [
                        0 => 0,
                        1 => 0,
                    ];
                }
                $bitOccurrences[$characterIndex][$value] = $bitOccurrences[$characterIndex][$value] + 1;
            }
        }

        return $bitOccurrences;
    }
}