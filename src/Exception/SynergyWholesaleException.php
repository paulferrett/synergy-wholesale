<?php namespace Hampel\SynergyWholesale\Exception;

class SynergyWholesaleException extends \Exception
{
	protected $status;

	protected $command;

	public function __construct($message = "", $code = 0, $status = "", $command = "", $previous = null)
	{
		$this->status = $status;
		$this->command = $command;
		parent::__construct($message, $code, $previous);
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