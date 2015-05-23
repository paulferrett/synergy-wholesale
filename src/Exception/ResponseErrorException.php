<?php namespace SynergyWholesale\Exception;

use stdClass;

class ResponseErrorException extends RuntimeException
{
	protected $response;

	protected $command;

	protected $status;

	public function __construct(stdClass $response, $command = "")
	{
		$this->response = $response;
		$this->command = $command;

		$this->status = $response->status;
		$message = $response->errorMessage;
		if (empty($message)) $message = $response->status;

		parent::__construct($message);
	}

	public function getResponse()
	{
		return $this->response;
	}

	public function getCommand()
	{
		return $this->command;
	}

	public function getStatus()
	{
		return $this->status;
	}
}
