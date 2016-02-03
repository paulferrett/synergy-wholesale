<?php  namespace SynergyWholesale\Responses;

use stdClass;

class DomainReleaseUkResponseTest extends \PHPUnit_Framework_TestCase
{
	public function testResponse()
	{
		$data = new stdClass;
		$data->status = "OK";

		$response = new DomainReleaseUkResponse($data, 'DomainReleaseUKCommand');

		$this->assertTrue($response->updateSuccessful());
	}
}
