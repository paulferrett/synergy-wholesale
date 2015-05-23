<?php  namespace SynergyWholesale\Responses;

use stdClass;

class UpdateNameServersResponseTest extends \PHPUnit_Framework_TestCase
{
	public function testResponse()
	{
		$data = new stdClass;
		$data->status = "OK";

		$response = new UpdateNameServersResponse($data, 'UpdateNameServersCommand');

		$this->assertTrue($response->updateSuccessful());
	}
}
