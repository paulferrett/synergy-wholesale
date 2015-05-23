<?php  namespace SynergyWholesale\Responses;

use stdClass;

class UpdateContactResponseTest extends \PHPUnit_Framework_TestCase
{
	public function testResponse()
	{
		$data = new stdClass;
		$data->status = "OK";

		$response = new UpdateContactResponse($data, 'UpdateContactCommand');

		$this->assertTrue($response->updateSuccessful());
	}
}
