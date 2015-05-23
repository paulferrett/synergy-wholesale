<?php  namespace SynergyWholesale\Responses;

use stdClass;

class UnlockDomainResponseTest extends \PHPUnit_Framework_TestCase
{
	public function testResponse()
	{
		$data = new stdClass;
		$data->status = "OK";

		$response = new UnlockDomainResponse($data, 'UnlockDomainCommand');

		$this->assertTrue($response->unlockSuccessful());
	}
}
