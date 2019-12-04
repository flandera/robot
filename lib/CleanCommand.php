<?php


namespace Robot;


use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\OutputInterface;

class CleanCommand extends \Symfony\Component\Console\Command\Command
{
	/**
	 * @var string
	 */
	protected static $defaultName = 'clean';

	public function __construct()
	{
		parent::__construct();
	}

	protected function configure()
	{
		$this->setHelp('call me with command clean  and parameters --floor=carpet|hard --area=int');
		$this->setDescription('Cleans a floor');
		$this->setDefinition(new InputDefinition([
			new InputOption('floor', 'f', InputOption::VALUE_REQUIRED, 'Type of floor?'),
			new InputOption('area', 'a', InputOption::VALUE_REQUIRED, 'Area to clean?')
		]));
	}

	/**
	 * @param InputInterface $input
	 * @param OutputInterface $output
	 * @return array|bool|int
	 */
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$logger = new ConsoleLogger($output);
		$area = $input->getOption('area');
		$surface = $input->getOption('floor');
		$robot = new CleaningRobot($logger, $area, $surface);
		return $robot->run();
	}
}