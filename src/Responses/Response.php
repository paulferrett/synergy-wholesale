<?php  namespace Hampel\SynergyWholesale\Responses;

use Hampel\SynergyWholesale\Exception\BadDataException;
use stdClass;

abstract class Response
{
	public $response;

	public $command;

	protected $expectedFields = array();

	public function __construct(stdClass $response, $command = "")
	{
		$this->response = $response;
		$this->command = $command;

		$this->validateData($response, $command);
	}

	protected function validateData(stdClass $data, $command)
	{
		if (empty($this->expectedFields)) return;

		foreach ($this->expectedFields as $expected)
		{
			if (!isset($data->{$expected}))
			{
				$message = "Expected property [{$expected}] missing from response data";
				throw new BadDataException($message, $command);
			}
		}
	}

}

?>
 