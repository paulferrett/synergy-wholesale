<?php  namespace SynergyWholesale\Responses; 

use stdClass;
use SynergyWholesale\Types\UsAppPurpose;
use SynergyWholesale\Types\UsNexusCategory;

class GetUsNexusDataResponseTest extends \PHPUnit_Framework_TestCase
{
	public function testResponse()
	{
		$data = new stdClass();
		$data->status = "OK";
		$data->nexusCategory = "C21";
		$data->nexusApplication = "P3";

		$response = new GetUsNexusDataResponse($data, 'GetUsNexusDataCommand');

		$this->assertInstanceOf('SynergyWholesale\Types\UsNexusCategory', $response->getNexusCategory());
		$this->assertTrue($response->getNexusCategory()->equals(UsNexusCategory::US_ORGANISATION()));
		$this->assertEquals(UsNexusCategory::US_ORGANISATION, $response->getNexusCategoryString());

		$this->assertInstanceOf('SynergyWholesale\Types\UsAppPurpose', $response->getNexusApplication());
		$this->assertTrue($response->getNexusApplication()->equals(UsAppPurpose::PERSONAL()));
		$this->assertEquals(UsAppPurpose::PERSONAL, $response->getNexusApplicationString());
	}
}
