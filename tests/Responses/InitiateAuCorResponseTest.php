<?php  namespace SynergyWholesale\Responses;

use stdClass;

class InitiateAuCorResponseTest extends \PHPUnit_Framework_TestCase
{
	public function testMissingCostPrice()
	{
		$data = new stdClass();
		$data->status = "OK";

		$this->setExpectedException('SynergyWholesale\Exception\BadDataException', 'Expected property [costPrice] missing from response data');

		new InitiateAuCorResponse($data, 'InitiateAuCorCommand');
	}

	public function testBadCostPrice()
	{
		$data = new stdClass();
		$data->status = "OK";
		$data->costPrice = "foo";

		$this->setExpectedException('SynergyWholesale\Exception\BadDataException', 'Expected a numeric cost price');

		new InitiateAuCorResponse($data, 'InitiateAuCorCommand');
	}

	public function testResponse()
	{
		$data = new stdClass();
		$data->status = "OK";
		$data->costPrice = "10.00";

		$response = new InitiateAuCorResponse($data, 'InitiateAuCorCommand');
		$this->assertEquals('10.00', $response->getCostPrice());
	}
}
