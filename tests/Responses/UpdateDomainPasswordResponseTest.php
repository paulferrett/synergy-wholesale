<?php  namespace SynergyWholesale\Responses;

use stdClass;

class UpdateDomainPasswordResponseTest extends \PHPUnit_Framework_TestCase
{
	public function testResponse()
	{
		$data = new stdClass;
		$data->status = "OK";

		$response = new UpdateDomainPasswordResponse($data, 'UpdateDomainPasswordCommand');

		$this->assertTrue($response->updateSuccessful());
	}
}
