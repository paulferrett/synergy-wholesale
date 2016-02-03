<?php  namespace SynergyWholesale\Commands;

use SynergyWholesale\Types\Email;
use SynergyWholesale\Types\Phone;
use SynergyWholesale\Types\AuState;
use SynergyWholesale\Types\AuDomain;
use SynergyWholesale\Types\AuIdType;
use SynergyWholesale\Types\AuContact;
use SynergyWholesale\Types\AuPostCode;
use SynergyWholesale\Types\DomainList;
use SynergyWholesale\Types\AuRegistrant;
use SynergyWholesale\Types\AuOrganisationType;
use SynergyWholesale\Types\RegistrationYears;

class DomainRegisterAuCommandTest extends \PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->domain = new AuDomain('example.com.au');
		$this->contact1 = new AuContact(
			'foo',
			'bar',
			'Foo Pty Ltd',
			'Suite 1',
			'Level 1',
			'Foo Street',
			'foobar',
			new AuState('NSW'),
			new AuPostCode('1111'),
			new Phone('+61.111111111'),
			new Email('foo@example.com'),
			new Phone('+61.111111112')
		);
		$this->contact2 = new AuContact(
			'foo2',
			'bar2',
			'Foo2 Pty Ltd',
			'Suite 2',
			'Level 2',
			'Bar Street',
			'barfoo',
			new AuState('VIC'),
			new AuPostCode('2222'),
			new Phone('+61.222222222'),
			new Email('foo2@example.com'),
			new Phone('+61.222222221')
		);
		$this->registrant = new AuRegistrant(
			'Foo Pty Ltd',
			'111111111',
			new AuOrganisationType('Company'),
			new AuIdType('ACN')
		);
		$this->years = new RegistrationYears(2);
		$this->nameServers = new DomainList(array('ns1.foo.com', 'ns2.foo.com'));
	}

	public function testCommand()
	{
		$command = new DomainRegisterAUCommand(
			$this->domain,
			$this->years,
			$this->nameServers,
			$this->contact1,
			$this->contact2,
			$this->registrant
		);
		$build = $command->getRequestData();

		$this->assertTrue(is_array($build));
		$this->assertArrayHasKey('domainName', $build);
		$this->assertEquals('example.com.au', $build['domainName']);
		$this->assertArrayHasKey('years', $build);
		$this->assertEquals(2, $build['years']);
		$this->assertArrayHasKey('nameServers', $build);
		$this->assertTrue(is_array($build['nameServers']));
		$this->assertArrayHasKey(0, $build['nameServers']);
		$this->assertEquals('ns1.foo.com', $build['nameServers'][0]);
		$this->assertArrayHasKey(1, $build['nameServers']);
		$this->assertEquals('ns2.foo.com', $build['nameServers'][1]);

		$this->assertArrayHasKey('registrant_firstname', $build);
		$this->assertEquals('foo', $build['registrant_firstname']);
		$this->assertArrayHasKey('registrant_lastname', $build);
		$this->assertEquals('bar', $build['registrant_lastname']);
		$this->assertArrayHasKey('registrant_organisation', $build);
		$this->assertEquals('Foo Pty Ltd', $build['registrant_organisation']);
		$this->assertArrayHasKey('registrant_address', $build);
		$this->assertTrue(is_array($build['registrant_address']));
		$this->assertArrayHasKey(0, $build['registrant_address']);
		$this->assertEquals('Suite 1', $build['registrant_address'][0]);
		$this->assertArrayHasKey(1, $build['registrant_address']);
		$this->assertEquals('Level 1', $build['registrant_address'][1]);
		$this->assertArrayHasKey(2, $build['registrant_address']);
		$this->assertEquals('Foo Street', $build['registrant_address'][2]);
		$this->assertArrayHasKey('registrant_suburb', $build);
		$this->assertEquals('foobar', $build['registrant_suburb']);
		$this->assertArrayHasKey('registrant_state', $build);
		$this->assertEquals('NSW', $build['registrant_state']);
		$this->assertArrayHasKey('registrant_country', $build);
		$this->assertEquals('AU', $build['registrant_country']);
		$this->assertArrayHasKey('registrant_postcode', $build);
		$this->assertEquals('1111', $build['registrant_postcode']);
		$this->assertArrayHasKey('registrant_phone', $build);
		$this->assertEquals('+61.111111111', $build['registrant_phone']);
		$this->assertArrayHasKey('registrant_fax', $build);
		$this->assertEquals('+61.111111112', $build['registrant_fax']);
		$this->assertArrayHasKey('registrant_email', $build);
		$this->assertEquals('foo@example.com', $build['registrant_email']);

		$this->assertArrayHasKey('technical_firstname', $build);
		$this->assertEquals('foo2', $build['technical_firstname']);
		$this->assertArrayHasKey('technical_lastname', $build);
		$this->assertEquals('bar2', $build['technical_lastname']);
		$this->assertArrayHasKey('technical_organisation', $build);
		$this->assertEquals('Foo2 Pty Ltd', $build['technical_organisation']);
		$this->assertArrayHasKey('technical_address', $build);
		$this->assertTrue(is_array($build['technical_address']));
		$this->assertArrayHasKey(0, $build['technical_address']);
		$this->assertEquals('Suite 2', $build['technical_address'][0]);
		$this->assertArrayHasKey(1, $build['technical_address']);
		$this->assertEquals('Level 2', $build['technical_address'][1]);
		$this->assertArrayHasKey(2, $build['technical_address']);
		$this->assertEquals('Bar Street', $build['technical_address'][2]);
		$this->assertArrayHasKey('technical_suburb', $build);
		$this->assertEquals('barfoo', $build['technical_suburb']);
		$this->assertArrayHasKey('technical_state', $build);
		$this->assertEquals('VIC', $build['technical_state']);
		$this->assertArrayHasKey('technical_country', $build);
		$this->assertEquals('AU', $build['technical_country']);
		$this->assertArrayHasKey('technical_postcode', $build);
		$this->assertEquals('2222', $build['technical_postcode']);
		$this->assertArrayHasKey('technical_phone', $build);
		$this->assertEquals('+61.222222222', $build['technical_phone']);
		$this->assertArrayHasKey('technical_fax', $build);
		$this->assertEquals('+61.222222221', $build['technical_fax']);
		$this->assertArrayHasKey('technical_email', $build);
		$this->assertEquals('foo2@example.com', $build['technical_email']);

		$this->assertArrayHasKey('registrantName', $build);
		$this->assertEquals('Foo Pty Ltd', $build['registrantName']);
		$this->assertArrayHasKey('registrantID', $build);
		$this->assertEquals('111111111', $build['registrantID']);
		$this->assertArrayHasKey('registrantIDType', $build);
		$this->assertEquals('ACN', $build['registrantIDType']);
		$this->assertArrayHasKey('eligibilityType', $build);
		$this->assertEquals('Company', $build['eligibilityType']);
		$this->assertArrayHasKey('eligibilityName', $build);
		$this->assertNull($build['eligibilityName']);
		$this->assertArrayHasKey('eligibilityID', $build);
		$this->assertNull($build['eligibilityID']);
		$this->assertArrayHasKey('eligibilityIDType', $build);
		$this->assertNull($build['eligibilityIDType']);
	}
}
