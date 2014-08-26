<?php  namespace SynergyWholesale\Commands;

use SynergyWholesale\Types\Email;
use SynergyWholesale\Types\Phone;
use SynergyWholesale\Types\Contact;
use SynergyWholesale\Types\Country;
use SynergyWholesale\Types\UsDomain;
use SynergyWholesale\Types\UsAppPurpose;
use SynergyWholesale\Types\UsNexusCategory;

class DomainRegisterUsCommandTest extends \PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->domain = new UsDomain('example.us');
		$this->contact = new Contact(
			'foo',
			'bar',
			'Foo Pty Ltd',
			'Suite 1',
			'Level 1',
			'Foo Street',
			'foobar',
			'state',
			new Country('US'),
			'postcode',
			new Phone('+61.111111111'),
			new Email('foo@example.com'),
			new Phone('+61.111111112')
		);
		$this->appPurpose = new UsAppPurpose('P1');
		$this->nexusCategory = new UsNexusCategory('C31');
	}

	public function testBadYears()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'Years parameter is required and should be a positive integer value');

		$command = new DomainRegisterUsCommand(
			$this->domain,
			null,
			array(),
			$this->contact,
			$this->appPurpose,
			$this->nexusCategory
		);
	}

	public function testBadYears2()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'Years parameter is required and should be a positive integer value');

		$command = new DomainRegisterUsCommand(
			$this->domain,
			-1,
			array(),
			$this->contact,
			$this->appPurpose,
			$this->nexusCategory
		);
	}

	public function testBadYears3()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'Years parameter is required and should be a positive integer value');

		$command = new DomainRegisterUsCommand(
			$this->domain,
			0,
			array(),
			$this->contact,
			$this->appPurpose,
			$this->nexusCategory
		);
	}

	public function testBadNameServers()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'Name server is not a valid domain name [ns1]');

		$command = new DomainRegisterUsCommand(
			$this->domain,
			1,
			array(
				'ns1',
				'ns2'
			),
			$this->contact,
			$this->appPurpose,
			$this->nexusCategory
);
	}

	public function testCommand()
	{
		$command = new DomainRegisterUsCommand(
			$this->domain,
			1,
			array(
				'ns1.foo.com',
				'ns2.foo.com'
			),
			$this->contact,
			$this->appPurpose,
			$this->nexusCategory
		);
		$build = $command->getRequestData();

		$this->assertTrue(is_array($build));
		$this->assertArrayHasKey('domainName', $build);
		$this->assertEquals('example.us', $build['domainName']);
		$this->assertArrayHasKey('years', $build);
		$this->assertEquals(1, $build['years']);
		$this->assertArrayHasKey('nameServers', $build);
		$this->assertTrue(is_array($build['nameServers']));
		$this->assertArrayHasKey(0, $build['nameServers']);
		$this->assertEquals('ns1.foo.com', $build['nameServers'][0]);
		$this->assertArrayHasKey(1, $build['nameServers']);
		$this->assertEquals('ns2.foo.com', $build['nameServers'][1]);

		$this->assertArrayHasKey('contact_firstname', $build);
		$this->assertEquals('foo', $build['contact_firstname']);
		$this->assertArrayHasKey('contact_lastname', $build);
		$this->assertEquals('bar', $build['contact_lastname']);
		$this->assertArrayHasKey('contact_organisation', $build);
		$this->assertEquals('Foo Pty Ltd', $build['contact_organisation']);
		$this->assertArrayHasKey('contact_address', $build);
		$this->assertTrue(is_array($build['contact_address']));
		$this->assertArrayHasKey(0, $build['contact_address']);
		$this->assertEquals('Suite 1', $build['contact_address'][0]);
		$this->assertArrayHasKey(1, $build['contact_address']);
		$this->assertEquals('Level 1', $build['contact_address'][1]);
		$this->assertArrayHasKey(2, $build['contact_address']);
		$this->assertEquals('Foo Street', $build['contact_address'][2]);
		$this->assertArrayHasKey('contact_suburb', $build);
		$this->assertEquals('foobar', $build['contact_suburb']);
		$this->assertArrayHasKey('contact_state', $build);
		$this->assertEquals('state', $build['contact_state']);
		$this->assertArrayHasKey('contact_country', $build);
		$this->assertEquals('US', $build['contact_country']);
		$this->assertArrayHasKey('contact_postcode', $build);
		$this->assertEquals('postcode', $build['contact_postcode']);
		$this->assertArrayHasKey('contact_phone', $build);
		$this->assertEquals('+61.111111111', $build['contact_phone']);
		$this->assertArrayHasKey('contact_fax', $build);
		$this->assertEquals('+61.111111112', $build['contact_fax']);
		$this->assertArrayHasKey('contact_email', $build);
		$this->assertEquals('foo@example.com', $build['contact_email']);

		$this->assertArrayHasKey('appPurpose', $build);
		$this->assertEquals('P1', $build['appPurpose']);
		$this->assertArrayHasKey('nexusCategory', $build);
		$this->assertEquals('C31', $build['nexusCategory']);
	}
}

?>
 