<?php  namespace SynergyWholesale\Responses;

use stdClass;
use SynergyWholesale\Exception\BadDataException;
use SynergyWholesale\Exception\ResponseErrorException;

abstract class Response
{
	/** @var \stdClass $response */
	protected $response;

	/** @var string $command */
	protected $command;

	/** @var array (string) $expectedFields list of field names we must find in the raw response for it to be considered valid */
	protected $expectedFields = array();

	/** @var array (string) $successStatus list of status values considered to represent a successful command execution */
	protected $successStatus = array('OK', 'ok');

	public function __construct(stdClass $response, $command)
	{
		$this->response = $response;
		$this->command = $command;

		$this->validateStatus();
		$this->validateExpectedFields();
		$this->validateData();
	}

	protected function validateStatus()
	{
		if (!isset($this->response->status))
		{
			$message = "No status found in response to Soap command [{$this->command}]";
			throw new BadDataException($message, $this->command, $this->response);
		}

		$this->arrayify($this->successStatus);

		// check the response status against the list of "success" status values
		if (!in_array($this->response->status, $this->successStatus))
		{
			// we got something other than success, so throw an exception
			throw new ResponseErrorException($this->response, $this->command);
		}
	}

	protected function validateExpectedFields()
	{
		if (empty($this->expectedFields)) return;

		$this->arrayify($this->expectedFields);

		foreach ($this->expectedFields as $expected)
		{
			if (!isset($this->response->{$expected}))
			{
				$message = "Expected property [{$expected}] missing from response data";
				throw new BadDataException($message, $this->command, $this->response);
			}
		}
	}

	protected function arrayify(&$data)
	{
		if (!is_array($data)) $data = array($data);
	}

	protected function validateData()
	{
		return; // do nothing by default - let subclasses provide their own implementation if they choose
	}

	/**
	 * @return stdClass raw response data
	 */
	public function getRawResponse()
	{
		return $this->response;
	}

	/**
	 * @return string command name
	 */
	public function getCommandName()
	{
		return $this->command;
	}

	public function getErrorMessage()
	{
		if (isset($this->response->errorMessage))
		{
			return $this->response->errorMessage;
		}
	}
}
