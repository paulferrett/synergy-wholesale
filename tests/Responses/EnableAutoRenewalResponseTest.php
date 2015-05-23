<?php  namespace SynergyWholesale\Responses;

use stdClass;

class EnableAutoRenewalResponseTest extends \PHPUnit_Framework_TestCase
{
	public function testResponse()
	{
		$data = new stdClass;
		$data->status = "OK";

		$response = new EnableAutoRenewalResponse($data, 'EnableAutoRenewalCommand');

		$this->assertTrue($response->enableSuccessful());
	}
}
