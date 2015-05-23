<?php  namespace SynergyWholesale\Types;

class AuRegistrantTest extends \PHPUnit_Framework_TestCase
{
	public function testMissingRegistrantName()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'Missing argument: registrantName');

		$reg = new AuRegistrant("", "", new AuOrganisationType('Company'));
	}

	public function testMissingRegistrantId()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'Missing argument for Company registrant: registrantId');

		$reg = new AuRegistrant("foo", "", new AuOrganisationType('Company'));
	}

	public function testNewMissingRegistrantName()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'registrantName parameter is required for a Registered Business');

		$br = new AuBusinessRegistration(
			"B111",
			"Registered",
			"",
			"foo",
			"",
			"",
			new AuOrganisationType('Registered Business'),
			new AuState('NSW')
		);

		$reg = AuRegistrant::newFromAuBusinessRegistration($br);
	}

	public function testRegistrant()
	{
		$reg = new AuRegistrant("foo", "bar", new AuOrganisationType('Company'));
		$this->assertEquals('foo', $reg->getRegistrantName());
		$this->assertEquals('bar', $reg->getRegistrantId());
		$this->assertInstanceOf('SynergyWholesale\Types\AuOrganisationType', $reg->getEligibilityType());
		$this->assertEquals('Company', $reg->getEligibilityType()->getOrganisationType());
	}

	public function testNew()
	{
		$br = new AuBusinessRegistration(
			"111111111",
			"Registered",
			"",
			"foo",
			"",
			"",
			new AuOrganisationType('Company')
		);

		$reg = AuRegistrant::newFromAuBusinessRegistration($br);
		$this->assertEquals('foo', $reg->getRegistrantName());
		$this->assertEquals('111111111', $reg->getRegistrantId());
		$this->assertEquals('ACN', $reg->getRegistrantIdTypeString());
		$this->assertEquals('Company', $reg->getEligibilityTypeString());
		$this->assertNull($reg->getEligibilityName());
		$this->assertNull($reg->getEligibilityId());
		$this->assertNull($reg->getEligibilityIdType());

		$br = new AuBusinessRegistration(
			"11111111111",
			"Registered",
			"",
			"foo",
			"",
			"",
			new AuOrganisationType('Company')
		);

		$reg = AuRegistrant::newFromAuBusinessRegistration($br);
		$this->assertEquals('ABN', $reg->getRegistrantIdType()->getIdType());

		$br = new AuBusinessRegistration(
			"B111",
			"Registered",
			"",
			"foo",
			"",
			"",
			new AuOrganisationType('Registered Business'),
			new AuState('NSW')
		);

		$reg = AuRegistrant::newFromAuBusinessRegistration($br, 'bar');
		$this->assertEquals('bar', $reg->getRegistrantName());
		$this->assertNull($reg->getRegistrantId());
		$this->assertNull($reg->getRegistrantIdTypeString());
		$this->assertEquals('Registered Business', $reg->getEligibilityTypeString());
		$this->assertEquals('foo', $reg->getEligibilityName());
		$this->assertEquals('B111', $reg->getEligibilityId());
		$this->assertEquals('NSW BN', $reg->getEligibilityIdTypeString());
	}
}
