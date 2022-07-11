<?php

namespace App\Tests\Unit;

use App\Services\AdventOfCodeInterface;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class AdventOfCodeTest extends TestCase
{
    private LoggerInterface $logger;
    private string $projectDir;

    protected function setUp(): void
    {
        parent::setUp();
        $this->logger = new NullLogger();
        $this->projectDir = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..');
    }

    /**
     * @return array[]
     */
    public function testAdventOfCodeData(): array
    {
        return [
            ['2021', '3_2', 230],
            ['2021', '3_1', 198],
        ];
    }

    /**
     * @dataProvider testAdventOfCodeData
     * @param string $year
     * @param string $day
     * @param int    $expectedAnswer
     */
    public function testAdventOfCode(string $year, string $day, int $expectedAnswer): void
    {
        $className = sprintf('App\Services\AdventOfCode%s_%s', $year, $day);
        /** @var AdventOfCodeInterface $dut */
        $dut = new $className($this->logger, $this->projectDir);
        $answer = $dut->solve($year, $day);
        $this->assertSame($expectedAnswer, $answer);
    }
}