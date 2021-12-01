<?php

namespace App\Services;

final class AdventOfCode2021_1_2 extends AbstractAdventOfCode
{
    public const SLIDING_WINDOW_SIZE = 3;

    /**
     * @param string $year
     * @param string $day
     * @return bool
     */
    public function solve(string $year, string $day): bool
    {
        /* This puzzle reuses the same input as 1_1 */
        $puzzleInput = $this->getPuzzleInput($year, '1_1');
        $this->logger->debug(sprintf('Found %d lines', count($puzzleInput)));
        $lastMeasurement = null;
        $measurementLargerCount = 0;
        $measurements = [];
        foreach ($puzzleInput as $measurement) {
            $measurement = (int)$measurement;
            $measurements[] = $measurement;
            $slicedMeasurements = array_slice($measurements, -1 * self::SLIDING_WINDOW_SIZE, self::SLIDING_WINDOW_SIZE);
            if (count($slicedMeasurements) === self::SLIDING_WINDOW_SIZE) {
                $totalMeasurement = $this->getMeasurementFromArray($slicedMeasurements);
                if ($lastMeasurement !== null) {
                    if ($totalMeasurement > $lastMeasurement) {
                        $measurementLargerCount++;
                    }
                }
                $lastMeasurement = $totalMeasurement;
            }
        }
        $this->logger->info(sprintf('Found %d larger measurements', $measurementLargerCount));

        return true;
    }

    /**
     * @param array<int, int> $measurements
     * @return int
     */
    private function getMeasurementFromArray(array $measurements): int
    {
        $totalMeasurement = 0;
        foreach ($measurements as $measurement) {
            $totalMeasurement += $measurement;
        }

        return $totalMeasurement;
    }
}