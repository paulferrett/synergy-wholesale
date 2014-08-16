<?php namespace Hampel\SynergyWholesale\Commands;

use stdClass;

class BalanceQueryCommandTest extends \PHPUnit_Framework_TestCase
{
	public function testBuild()
	{
		$command = new BalanceQueryCommand();
		$build = $command->getRequestData();

		$this->assertTrue(is_array($build));
		$this->assertTrue(empty($build));
	}
/*
	public function testParseResponseMissingStatus()
	{
		$response = new stdClass();

		$this->setExpectedException('Hampel\SynergyWholesale\Exception\ResponseErrorException', 'Expected property [status] missing from response data');

		$command = new BalanceQueryCommand();
		$command->parseResponse($response);
	}

	public function testParseResponseMissingBalance()
	{
		$response = new stdClass();
		$response->status = "foo";

		$this->setExpectedException('Hampel\SynergyWholesale\Exception\ResponseErrorException', 'Expected property [balance] missing from response data');

		$command = new BalanceQueryCommand();
		$command->parseResponse($response);
	}

	public function testParseResponseNoErrorMessage()
	{
		$response = new stdClass();
		$response->status = "foo";
		$response->balance = "bar";

		$this->setExpectedException('Hampel\SynergyWholesale\Exception\ResponseErrorException', 'Unknown error');

		$command = new BalanceQueryCommand();
		$command->parseResponse($response);
	}

	public function testParseResponseWithErrorMessage()
	{
		$response = new stdClass();
		$response->status = "foo";
		$response->balance = "bar";
		$response->errorMessage = "baz";

		$this->setExpectedException('Hampel\SynergyWholesale\Exception\ResponseErrorException', 'baz');

		$command = new BalanceQueryCommand();
		$command->parseResponse($response);
	}

	public function testParseResponse()
	{
		$response = new stdClass();
		$response->status = "OK";
		$response->balance = "bar";

		$command = new BalanceQueryCommand();
		$data = $command->parseResponse($response);

		$this->assertEquals('bar', $data);
	}
*/
}

?>