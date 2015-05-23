<?php  namespace SynergyWholesale\Responses;

use stdClass;

class BalanceQueryResponseTest extends \PHPUnit_Framework_TestCase
{
	public function testMissingBalance()
	{
		$data = new stdClass();
		$data->status = "OK";

		$this->setExpectedException('SynergyWholesale\Exception\BadDataException', 'Expected property [balance] missing from response data');

		new BalanceQueryResponse($data, 'BalanceQueryCommand');
	}

	public function testResponse()
	{
		$data = new stdClass();
		$data->status = "OK";
		$data->balance = 100;

		$response = new BalanceQueryResponse($data, 'BalanceQueryCommand');

		$this->assertEquals(100, $response->getBalance());
	}
}
