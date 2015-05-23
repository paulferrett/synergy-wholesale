<?php  namespace SynergyWholesale\Responses;

use stdClass;

class GetDomainExtensionOptionsResponseTest extends \PHPUnit_Framework_TestCase
{
	public function testResponse()
	{
		$data = new stdClass();
		$data->status = "OK";
		$data->canRenew = 'yes';
		$data->canRenewWithin = 90;
		$data->cannotRenewAfter = 30;
		$data->isIPV4Capable = 'yes';
		$data->isIPV6Capable = 'yes';
		$data->isIDProtectCapable = 'no';
		$data->transferLock = 'no';
		$data->isHostsCapable = 'yes';
		$data->minYears = 2;
		$data->maxYears = 2;

		$response = new GetDomainExtensionOptionsResponse($data, 'GetDomainExtensionOptionsCommand');

		$this->assertTrue($response->canRenew());
		$this->assertEquals(90, $response->canRenewWithin());
		$this->assertEquals(30, $response->cannotRenewAfter());
		$this->assertTrue($response->isIpV4Capable());
		$this->assertTrue($response->isIpv6Capable());
		$this->assertFalse($response->isIdProtectCapable());
		$this->assertFalse($response->transferLock());
		$this->assertTrue($response->isHostsCapable());
		$this->assertEquals(2, $response->getMinYears());
		$this->assertEquals(2, $response->getMaxYears());
	}
}
