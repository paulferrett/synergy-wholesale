<?php  namespace SynergyWholesale\Responses;

use stdClass;

class CanRenewDomainResponseTest extends \PHPUnit_Framework_TestCase
{
	public function testResponse()
	{
		$data = new stdClass();
		$data->status = 'OK_RENEW';
		$data->yearsCanRenewFor = 2;

		$response = new CanRenewDomainResponse($data, 'CanRenewDomainCommand');

		$this->assertTrue($response->isRenewable());
		$this->assertEquals(2, $response->getYearsCanRenewFor());

		$data = new stdClass();
		$data->status = 'OK_NO_RENEWAL';

		$response = new CanRenewDomainResponse($data, 'CanRenewDomainCommand');

		$this->assertFalse($response->isRenewable());
		$this->assertNull($response->getYearsCanRenewFor());
	}
}

?>
 