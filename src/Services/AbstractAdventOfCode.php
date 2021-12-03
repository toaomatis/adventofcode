<?php

namespace App\Services;

use Psr\Log\LoggerInterface;

abstract class AbstractAdventOfCode implements AdventOfCodeInterface
{
    protected LoggerInterface $logger;
    private string $projectDir;

    /**
     * @param LoggerInterface $logger
     * @param string          $projectDir
     */
    public function __construct(LoggerInterface $logger, string $projectDir)
    {
        $this->logger = $logger;
        $this->projectDir = $projectDir;
    }

    /**
     * @param string $year
     * @param string $day
     * @return array<int, string>
     */
    protected function getPuzzleInput(string $year, string $day): array
    {
        $puzzleInputPath = $this->projectDir . DIRECTORY_SEPARATOR . 'inputs' . DIRECTORY_SEPARATOR . $year . DIRECTORY_SEPARATOR . $day . '.txt';
        $puzzleInput = file($puzzleInputPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $this->logger->debug(sprintf('Found %d lines', count($puzzleInput)));

        return $puzzleInput;
    }
}