<?php

namespace App\Services;

interface AdventOfCodeInterface
{
    /**
     * @param string $year
     * @param string $day
     * @return int
     */
    public function solve(string $year, string $day): int;
}