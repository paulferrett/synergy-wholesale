<?php  namespace Hampel\SynergyWholesale\Responses;

use stdClass;
use Hampel\SynergyWholesale\Exception\BadDataException;

abstract class Response
{
	public $response;

	public $command;

	protected $expectedFields = array();

	protected $successStatus = array('OK');

	public function __construct(stdClass $response, $command = "")
	{
		$this->response = $response;
		$this->command = $command;

		$this->validateExpectedFields();
		$this->validateResponseStatus();
		$this->validateData();
	}

	abstract public function validateData();

	protected function validateExpectedFields()
	{
		if (!isset($this->response->status))
		{
			$message = "No status found in response to Soap command [{$command}]";
			throw new BadDataException($message, $command, $this->response);
		}

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

	protected function validateResponseStatus()
	{
		$this->arrayify($this->successStatus);

		// check the response status against the list of "success" status values
		if (!in_array($this->response->status, $this->successStatus))
		{
			// we got something other than success, so throw an exception
			throw new ResponseErrorException($this->response, $this->command);
		}
	}

	protected function arrayify(&$data)
	{
		if (!is_array($data)) $data = array($data);
	}
}

?>
 