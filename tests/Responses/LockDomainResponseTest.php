<?php  namespace SynergyWholesale\Responses;

use stdClass;

class LockDomainResponseTest extends \PHPUnit_Framework_TestCase
{
	public function testResponse()
	{
		$data = new stdClass;
		$data->status = "OK";

		$response = new LockDomainResponse($data, 'LockDomainCommand');

		$this->assertTrue($response->lockSuccessful());
	}
}
