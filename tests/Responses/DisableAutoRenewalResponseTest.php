<?php  namespace SynergyWholesale\Responses;

use stdClass;

class DisableAutoRenewalResponseTest extends \PHPUnit_Framework_TestCase
{
	public function testResponse()
	{
		$data = new stdClass;
		$data->status = "OK";

		$response = new DisableAutoRenewalResponse($data, 'DisableAutoRenewalCommand');

		$this->assertTrue($response->disableSuccessful());
	}
}
