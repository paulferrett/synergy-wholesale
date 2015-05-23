<?php  namespace SynergyWholesale\Responses;

use stdClass;

class ResendVerificationEmailResponseTest extends \PHPUnit_Framework_TestCase
{
	public function testResponse()
	{
		$data = new stdClass;
		$data->status = "OK";

		$response = new ResendVerificationEmailResponse($data, 'ResendVerificationEmailCommand');

		$this->assertTrue($response->resendSuccessful());
	}
}
