<?php


namespace Robot;


use Symfony\Component\Console\Logger\ConsoleLogger;

class CleaningRobot extends AbstractRobot implements Robot
{
	/**
	 * @var ConsoleLogger
	 */
	private $logger;

	/**
	 * @var int
	 */
	private $totalTime;

	/**
	 * CleaningRobot constructor.
	 * @param ConsoleLogger $logger
	 * @param int $area area to clean
	 * @param string $surface type of area
	 */
	public function __construct(ConsoleLogger $logger, $area, $surface)
	{
		$this->surface = $surface;
		$this->area = $area;
		$this->logger = $logger;
		$this->setSpeed($surface);
	}

	/**
	 * @param string $surface
	 * @return float|int
	 */
	private function setSpeed(string $surface)
	{
		if ($surface === self::CARPET) {
			$this->speed = 0.5;
		}
		return $this->speed;
	}

	public function run()
	{
		$this->clean();
		return $this->returnCode;
	}

	/**
	 * @param int $areaCleaned already cleaned area
	 * @return array
	 */
	public function clean($areaCleaned = 0)
	{
		for (; $areaCleaned < $this->area; $areaCleaned += $this->speed) {
			if ($this->cleaningTime > self::BATTERY_LIFE_TIME) {
				$this->recharge($areaCleaned -= $this->speed);
			}
			$this->logger->info('Cleaned : ' . $areaCleaned . ' meter');
			$this->cleaningTime++;
			$this->totalTime++;
		}
		$this->logger->info('Finished cleaning : ' . $areaCleaned . ' meters');
		$this->returnCode = self::RETURN_CODE_SUCCESS;
		return [$areaCleaned, $this->totalTime];
//		exit(0);
	}

	/**
	 * @param int $areaCleaned already cleaned area
	 */
	private function recharge($areaCleaned = 0)
	{
		for ($chargingTime = 0; $chargingTime < self::BATTERY_CHARGE_TIME; $chargingTime++) {
			$this->logger->info('Charging ' . ($chargingTime + 1) . ' seconds');
		}
		$this->cleaningTime = 0;
		$this->logger->info('Charged for: ' . $chargingTime . ' seconds. Fully charged, going to clean...');
		$this->clean($areaCleaned);
	}
}