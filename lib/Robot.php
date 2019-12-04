<?php


namespace Robot;


use Symfony\Component\Console\Logger\ConsoleLogger;

interface Robot
{
	/**
	 * @return mixed
	 */
	public function clean();
}