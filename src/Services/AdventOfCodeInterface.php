<?php

namespace App\Services;

interface AdventOfCodeInterface
{
    /**
     * @return bool
     */
    public function solve(): bool;
}