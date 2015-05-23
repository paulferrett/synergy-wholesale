<?php namespace SynergyWholesale\Exception;

use stdClass;

class BadDataException extends RuntimeException
{
	protected $command;

	protected $response;

	public function __construct($message = "", $command = "", stdClass $response = null)
	{
		$this->command = $command;
		$this->response = $response;
		parent::__construct($message);
	}

	public function getCommand()
	{
		return $this->command;
	}

	public function getResponse()
	{
		return $this->response;
	}
}
