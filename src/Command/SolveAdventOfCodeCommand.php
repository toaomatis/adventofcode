<?php

namespace App\Command;

use App\Kernel;
use App\Services\AdventOfCodeInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class SolveAdventOfCodeCommand extends Command
{
    public const ARGUMENT_YEAR = 'year';
    public const ARGUMENT_DAY = 'day';

    protected static $defaultName = 'app:solve:advent-of-code';
    protected static $defaultDescription = 'Solves Advent of Code puzzle';

    private Kernel $kernel;
    private LoggerInterface $logger;

    /**
     * @param Kernel          $kernel
     * @param LoggerInterface $logger
     * @param string|null     $name
     */
    public function __construct(Kernel $kernel, LoggerInterface $logger, string $name = null)
    {
        $this->kernel = $kernel;
        $this->logger = $logger;
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->addArgument(self::ARGUMENT_DAY, InputArgument::REQUIRED, 'The AoC Day within the Year')
            ->addArgument(self::ARGUMENT_YEAR, InputArgument::OPTIONAL, 'The AoC Year', '2021');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $year = $input->getArgument(self::ARGUMENT_YEAR);
        $day = $input->getArgument(self::ARGUMENT_DAY);
        $serviceName = sprintf('advent_of_code.%s.%s', $year, $day);

        $this->logger->debug(sprintf('Solving %s', $serviceName), ['year' => $year, 'day' => $day]);

        $container = $this->kernel->getContainer();
        /** @var AdventOfCodeInterface $adventOfCode */
        $adventOfCode = $container->get($serviceName);

        return $adventOfCode->solve($year, $day) ? Command::SUCCESS : Command::FAILURE;
    }
}