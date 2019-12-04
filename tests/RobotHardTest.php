<?php


namespace tests;


use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Robot\CleaningRobot;
use Symfony\Component\Console\Logger\ConsoleLogger;

class RobotHardTest extends TestCase
{
	/**
	 * @var CleaningRobot
	 */
	private $robot;

	public function testSetSpeed()
	{
		$this->assertSame(1, $this->invokeMethod($this->robot, 'setSpeed', ['surface' => 'hard']));
	}

	public function invokeMethod(&$object, $methodName, array $parameters = array())
	{
		try {
			$reflection = new ReflectionClass(get_class($object));
			$method = $reflection->getMethod($methodName);
			$method->setAccessible(true);

			return $method->invokeArgs($object, $parameters);
		} catch (\ReflectionException $e) {
		}
	}

	public function testDurationOfCleaning()
	{
		$this->assertSame([70, 100], $this->robot->clean());
	}

	public function testRechargeTime()
	{
		$this->assertSame(30, $this->invokeMethod($this->robot, 'recharge'));
	}

	protected function setUp(): void
	{
		$logger = $this->createMock(ConsoleLogger::class);
		$this->robot = new CleaningRobot($logger, 70, 'hard');
	}
}