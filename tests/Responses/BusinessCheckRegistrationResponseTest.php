<?php  namespace SynergyWholesale\Responses;

use stdClass;

class BusinessCheckRegistrationResponseTest extends \PHPUnit_Framework_TestCase
{
	public function testMissingEntityStatus()
	{
		$data = new stdClass();
		$data->status = "OK";

		$this->setExpectedException('SynergyWholesale\Exception\BadDataException', 'Expected property [entityStatus] missing from response data');

		new BusinessCheckRegistrationResponse($data, 'BusinessCheckRegistrationCommand');
	}

	public function testMissingEntityName()
	{
		$data = new stdClass();
		$data->status = "OK";
		$data->entityStatus = "foo";

		$this->setExpectedException('SynergyWholesale\Exception\BadDataException', 'Expected property [entityName] missing from response data');

		new BusinessCheckRegistrationResponse($data, 'BusinessCheckRegistrationCommand');
	}

	public function testResponse()
	{
		$data = new stdClass();
		$data->status = "OK";
		$data->entityStatus = "Registered";
		$data->entityName = "Foo Pty Ltd";
		$data->organisationType = "Company";

		$response = new BusinessCheckRegistrationResponse($data, 'BusinessCheckRegistrationCommand');

		$this->assertNull($response->getRegistrationNumber());
		$this->assertEquals('Registered', $response->getEntityStatus());
		$this->assertNull($response->getAsicNumber());
		$this->assertEquals('Foo Pty Ltd', $response->getEntityName());
		$this->assertNull($response->getTradingName());
		$this->assertNull($response->getLegalName());
		$this->assertEquals('Company', $response->getOrganisationType());
		$this->assertNull($response->getState());
		$this->assertNull($response->getPostcode());

		$reg = $response->getAuBusinessRegistration('111111111');

		$this->assertInstanceOf('SynergyWholesale\Types\AuBusinessRegistration', $reg);
		$this->assertEquals('111111111', $reg->getRegistrationNumber());
		$this->assertEquals('Registered', $reg->getEntityStatus());
		$this->assertNull($reg->getAsicNumber());
		$this->assertEquals('Foo Pty Ltd', $reg->getEntityName());
		$this->assertNull($reg->getTradingName());
		$this->assertNull($reg->getLegalName());
		$this->assertEquals('Company', $reg->getOrganisationTypeName());
		$this->assertNull($reg->getStateName());
		$this->assertNull($reg->getPostcodeString());
	}

	public function testResponse2()
	{
		$data = new stdClass();
		$data->status = "OK";
		$data->registrationNumber = '11111111111';
		$data->entityStatus = "Active";
		$data->asicNumber = "111111111";
		$data->entityName = "Foo Pty Ltd";
		$data->tradingName = "Foo's Bar";
		$data->legalName = "";
		$data->organisationType = "Company";
		$data->state = "NSW";
		$data->postcode = "2000";

		$response = new BusinessCheckRegistrationResponse($data, 'BusinessCheckRegistrationCommand');

		$this->assertEquals('11111111111', $response->getRegistrationNumber());
		$this->assertEquals('Active', $response->getEntityStatus());
		$this->assertEquals('111111111', $response->getAsicNumber());
		$this->assertEquals('Foo Pty Ltd', $response->getEntityName());
		$this->assertEquals('Foo\'s Bar', $response->getTradingName());
		$this->assertEquals('', $response->getLegalName());
		$this->assertEquals('Company', $response->getOrganisationType());
		$this->assertEquals('NSW', $response->getState());
		$this->assertEquals('2000', $response->getPostcode());

		$reg = $response->getAuBusinessRegistration('11111111111');

		$this->assertInstanceOf('SynergyWholesale\Types\AuBusinessRegistration', $reg);
		$this->assertEquals('11111111111', $reg->getRegistrationNumber());
		$this->assertEquals('Active', $reg->getEntityStatus());
		$this->assertEquals('111111111', $reg->getAsicNumber());
		$this->assertEquals('Foo Pty Ltd', $reg->getEntityName());
		$this->assertEquals('Foo\'s Bar', $reg->getTradingName());
		$this->assertEquals('', $reg->getLegalName());
		$this->assertEquals('Company', $reg->getOrganisationTypeName());
		$this->assertEquals('NSW', $reg->getStateName());
		$this->assertEquals('2000', $reg->getPostcodeString());
	}

	public function testResponse3()
	{
		$data = new stdClass();
		$data->status = "OK";
		$data->registrationNumber = 'foo';
		$data->registrationState = 'VIC';
		$data->entityStatus = "Registered";
		$data->entityName = "Foo's Bar";

		$response = new BusinessCheckRegistrationResponse($data, 'BusinessCheckRegistrationCommand');

		$this->assertEquals('foo', $response->getRegistrationNumber());
		$this->assertEquals('Registered', $response->getEntityStatus());
		$this->assertNull($response->getAsicNumber());
		$this->assertEquals('Foo\'s Bar', $response->getEntityName());
		$this->assertNull($response->getTradingName());
		$this->assertNull($response->getLegalName());
		$this->assertNull($response->getOrganisationType());
		$this->assertEquals('VIC', $response->getState());
		$this->assertNull($response->getPostcode());

		$reg = $response->getAuBusinessRegistration('11111111111');

		$this->assertInstanceOf('SynergyWholesale\Types\AuBusinessRegistration', $reg);
		$this->assertEquals('foo', $reg->getRegistrationNumber());
		$this->assertEquals('Registered', $reg->getEntityStatus());
		$this->assertNull($reg->getAsicNumber());
		$this->assertEquals('Foo\'s Bar', $reg->getEntityName());
		$this->assertNull($reg->getTradingName());
		$this->assertNull($reg->getLegalName());
		$this->assertEquals('Registered Business', $reg->getOrganisationTypeName());
		$this->assertEquals('VIC', $reg->getStateName());
		$this->assertNull($reg->getPostcodeString());
	}

	public function testResponse4()
	{
		$data = new stdClass();
		$data->status = "OK";
		$data->entityStatus = "Registered";
		$data->entityName = "Foo's Bar";

		$response = new BusinessCheckRegistrationResponse($data, 'BusinessCheckRegistrationCommand');

		$this->assertNull($response->getRegistrationNumber());
		$this->assertEquals('Registered', $response->getEntityStatus());
		$this->assertNull($response->getAsicNumber());
		$this->assertEquals('Foo\'s Bar', $response->getEntityName());
		$this->assertNull($response->getTradingName());
		$this->assertNull($response->getLegalName());
		$this->assertNull($response->getOrganisationType());
		$this->assertNull($response->getState());
		$this->assertNull($response->getPostcode());

		$reg = $response->getAuBusinessRegistration('11111111111', 'VIC');

		$this->assertInstanceOf('SynergyWholesale\Types\AuBusinessRegistration', $reg);
		$this->assertEquals('11111111111', $reg->getRegistrationNumber());
		$this->assertEquals('Registered', $reg->getEntityStatus());
		$this->assertNull($reg->getAsicNumber());
		$this->assertEquals('Foo\'s Bar', $reg->getEntityName());
		$this->assertNull($reg->getTradingName());
		$this->assertNull($reg->getLegalName());
		$this->assertEquals('Registered Business', $reg->getOrganisationTypeName());
		$this->assertEquals('VIC', $reg->getStateName());
		$this->assertNull($reg->getPostcodeString());
	}
}
