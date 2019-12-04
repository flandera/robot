<?php


namespace Robot;


use Symfony\Component\Console\Logger\ConsoleLogger;

abstract class AbstractRobot
{
	/**
	 * durability of battery in seconds
	 */
	CONST BATTERY_LIFE_TIME = 60;

	/**
	 * Time to recharge battery in seconds
	 */
	const BATTERY_CHARGE_TIME = 30;

	/**
	 * floor surface carpet
	 */
	const CARPET = 'carpet';


	const RETURN_CODE_ERROR = 1;

	const RETURN_CODE_SUCCESS = 0;

	/**
	 * @var int $speed
	 * cleaning speed in meters/second
	 */
	protected $speed = 1;

	/**
	 * @var int $area
	 * area to clean in m2
	 */
	protected $area;

	/**
	 * @var string $surface
	 * type of surface corresponding to one of two constants 'hard' and 'carpet'
	 */
	protected $surface;

	/**
	 * @var int $cleaningTime
	 * duration of current cleaning
	 */
	protected $cleaningTime = 0;

	/**
	 * @var int
	 */
	protected $returnCode = self::RETURN_CODE_ERROR;

	/**
	 * @var ConsoleLogger
	 */
	protected $logger;

	/**
	 * @var int
	 */
	protected $totalTime = 0;
}