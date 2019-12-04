<?php


namespace tests;


use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Robot\CleaningRobot;
use Symfony\Component\Console\Logger\ConsoleLogger;

class RobotCarpetTest extends TestCase
{
	/**
	 * @var CleaningRobot
	 */
	private $robot;

	public function testSetSpeed()
	{
		$this->assertSame(0.5, $this->invokeMethod($this->robot, 'setSpeed', ['surface' => 'carpet']));
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
		$this->assertSame([70, 200], $this->robot->clean());
	}

	protected function setUp(): void
	{
		$logger = $this->createMock(ConsoleLogger::class);
		$this->robot = new CleaningRobot($logger, 70, 'carpet');
	}
}