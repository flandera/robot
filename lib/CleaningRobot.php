<?php


namespace Robot;


use Symfony\Component\Console\Logger\ConsoleLogger;

class CleaningRobot extends AbstractRobot implements Robot
{
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
	 * @return array
	 */
	public function clean()
	{
		$areaCleaned = 0;
		while ($areaCleaned < $this->area) {
			$this->cleaningTime++;
			$this->totalTime++;
			$areaCleaned += $this->speed;
			$this->logger->info('Cleaning : ' . $areaCleaned . ' meter');
			if ($this->cleaningTime === self::BATTERY_LIFE_TIME) {
				$this->recharge();
			}
		}
		$this->logger->info('Finished cleaning : ' . $areaCleaned . ' meters');
		$this->returnCode = self::RETURN_CODE_SUCCESS;
		return [(int)$areaCleaned, $this->totalTime];
	}

	/**
	 * @return int
	 */
	private function recharge()
	{
		$chargingTime = 0;
		while ($chargingTime < self::BATTERY_CHARGE_TIME) {
			$chargingTime++;
			$this->logger->info('Charging ' . ($chargingTime) . ' second/s');
		}
		$this->cleaningTime = 0;
		$this->totalTime += $chargingTime;
		$this->logger->info('Charged for: ' . $chargingTime . ' seconds. Fully charged, going to clean...');
		return $chargingTime;
	}
}