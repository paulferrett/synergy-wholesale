<?php namespace SynergyWholesale\Exception;

class SoapException extends RuntimeException
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
