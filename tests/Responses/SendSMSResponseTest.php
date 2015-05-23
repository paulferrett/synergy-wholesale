<?php  namespace SynergyWholesale\Responses;

use stdClass;

class SendSMSResponseTest extends \PHPUnit_Framework_TestCase
{
	public function testResponse()
	{
		$data = new stdClass();
		$data->status = "OK";
		$data->msgCount = 2;
		$data->perMsgCost = 0.12;
		$data->totalMsgCost = 0.24;

		$response = new SendSMSResponse($data, 'SendSMSCommand');

		$this->assertEquals(2, $response->getMsgCount());
		$this->assertEquals(0.12, $response->getPerMsgCost());
		$this->assertEquals(0.24, $response->getTotalMsgCost());
	}
}
