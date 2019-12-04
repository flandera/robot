<?php


namespace tests;


use PHPUnit\Framework\MockObject\MockBuilder;
use PHPUnit\Framework\TestCase;
use Robot\CleaningRobot;
use Symfony\Component\Console\Logger\ConsoleLogger;

class RobotTest extends TestCase
{
	/**
	 * @var CleaningRobot
	 */
	private $robot;

	public function testDurationOfCleaning()
	{
		$this->assertSame([70, 70], $this->robot->clean());
	}

	protected function setUp(): void
	{
		$logger = $this->createMock(ConsoleLogger::class);
		$this->robot = new CleaningRobot($logger, 70, 'hard');
	}
}