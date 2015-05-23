<?php  namespace SynergyWholesale\Types;

class AuBusinessRegistrationTest extends \PHPUnit_Framework_TestCase {

	public function testAuBusinessRegistration()
	{
		$br = new AuBusinessRegistration(
			"11111111111",
			"Registered",
			"111111111",
			"foo",
			"bar",
			"foobar",
			new AuOrganisationType('Company'),
			new AuState('NSW'),
			new AuPostCode('2000')
		);

		$this->assertEquals('11111111111', $br->getRegistrationNumber());
		$this->assertEquals('Registered', $br->getEntityStatus());
		$this->assertEquals('111111111', $br->getAsicNumber());
		$this->assertEquals('foo', $br->getEntityName());
		$this->assertEquals('bar', $br->getTradingName());
		$this->assertEquals('foobar', $br->getLegalName());
		$this->assertInstanceOf('SynergyWholesale\Types\AuOrganisationType', $br->getOrganisationType());
		$this->assertEquals('Company', $br->getOrganisationType()->getOrganisationType());
		$this->assertEquals('Company', $br->getOrganisationTypeName());
		$this->assertInstanceOf('SynergyWholesale\Types\AuState', $br->getState());
		$this->assertEquals('NSW', $br->getState()->getState());
		$this->assertEquals('NSW', $br->getStateName());
		$this->assertInstanceOf('SynergyWholesale\Types\AuPostCode', $br->getPostcode());
		$this->assertEquals('2000', $br->getPostcode()->getPostcode());
		$this->assertEquals('2000', $br->getPostcodeString());
	}

}
