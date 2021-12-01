<?php

namespace App\Services;

final class AdventOfCode2021_1_1 extends AbstractAdventOfCode
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
        $lastMeasurement = null;
        $measurementLargerCount = 0;
        foreach ($puzzleInput as $measurement) {
            $measurement = (int)$measurement;
            if ($lastMeasurement !== null) {
                if ($measurement > $lastMeasurement) {
                    $measurementLargerCount++;
                }
            }
            $lastMeasurement = $measurement;
        }
        $this->logger->info(sprintf('Found %d larger measurements', $measurementLargerCount));

        return true;
    }
}