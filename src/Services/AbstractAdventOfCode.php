<?php

namespace App\Services;

use Psr\Log\LoggerInterface;

abstract class AbstractAdventOfCode implements AdventOfCodeInterface
{
    protected LoggerInterface $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}