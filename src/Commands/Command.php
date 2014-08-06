<?php namespace Hampel\SynergyWholesale\Commands;

abstract class Command implements CommandInterface
{
	/** @var string the soap command to be executed */
	protected $command;

	public function getCommand()
	{
		return $this->command;
	}

	/**
	 * @return array 			the key-value pairs to send in the query
	 */
	abstract public function build();

}

?>
