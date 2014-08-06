<?php namespace Hampel\SynergyWholesale\Exception;

class SynergyWholesaleErrorException extends SynergyWholesaleException
{
	protected $status;

	protected $command;

	public function __construct($message = "", $code = 0, $status = "", $command = "")
	{
		$this->status = $status;
		$this->command = $command;
		parent::__construct($message, $code);
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function getCommand()
	{
		return $this->command;
	}
}

?>