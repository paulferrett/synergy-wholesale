<?php  namespace SynergyWholesale\Responses;

use stdClass;

class ResendTransferEmailResponseTest extends \PHPUnit_Framework_TestCase
{
	public function testMissingEmail()
	{
		$data = new stdClass();
		$data->status = "OK";

		$this->setExpectedException('SynergyWholesale\Exception\BadDataException', 'Expected property [newEmail] missing from response data');

		new ResendTransferEmailResponse($data, 'ResendTransferEmailCommand');
	}

	public function testBadEmail()
	{
		$data = new stdClass();
		$data->status = "OK";
		$data->newEmail = 'foo';

		$this->setExpectedException('SynergyWholesale\Exception\BadDataException', 'Response parameter newEmail should contain an email address');

		new ResendTransferEmailResponse($data, 'ResendTransferEmailCommand');
	}

	public function testResponse()
	{
		$data = new stdClass();
		$data->status = "OK";
		$data->newEmail = 'foo@example.com';

		$response = new ResendTransferEmailResponse($data, 'ResendTransferEmailCommand');

		$this->assertEquals('foo@example.com', $response->getNewEmail());
	}
}
