<?php  namespace SynergyWholesale\Responses;

use stdClass;

class DisableIdProtectionResponseTest extends \PHPUnit_Framework_TestCase
{
	public function testResponse()
	{
		$data = new stdClass;
		$data->status = "OK";

		$response = new DisableIdProtectionResponse($data, 'DisableIdProtectionCommand');

		$this->assertTrue($response->disableSuccessful());
	}
}
