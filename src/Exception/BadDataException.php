<?php namespace Hampel\SynergyWholesale\Exception;

class BadDataException extends SynergyWholesaleException
{
	protected $command;

	public function __construct($message = "", $command = "")
	{
		$this->command = $command;
		parent::__construct($message);
	}

	public function getCommand()
	{
		return $this->command;
	}
}

?>