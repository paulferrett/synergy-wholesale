<?php  namespace SynergyWholesale\Responses;

use stdClass;

class DetermineSmsCostResponseTest extends \PHPUnit_Framework_TestCase
{
	public function testResponse()
	{
		$data = new stdClass();
		$data->status = "OK";
		$data->msgCount = 2;
		$data->perMsgCost = 0.12;
		$data->totalMsgCost = 0.24;

		$response = new DetermineSMSCostResponse($data, 'DetermineSmsCostCommand');

		$this->assertEquals(2, $response->getMsgCount());
		$this->assertEquals(0.12, $response->getPerMsgCost());
		$this->assertEquals(0.24, $response->getTotalMsgCost());
	}
}
