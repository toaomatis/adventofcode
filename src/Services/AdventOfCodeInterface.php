<?php

namespace App\Services;

interface AdventOfCodeInterface
{
    /**
     * @param string $year
     * @param string $day
     * @return bool
     */
    public function solve(string $year, string $day): bool;
}