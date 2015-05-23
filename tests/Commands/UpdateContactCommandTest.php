<?php  namespace SynergyWholesale\Commands;

use SynergyWholesale\Types\Email;
use SynergyWholesale\Types\Phone;
use SynergyWholesale\Types\Domain;
use SynergyWholesale\Types\Contact;
use SynergyWholesale\Types\Country;

class UpdateContactCommandTest extends \PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->domain = new Domain('example.com');
		$this->contact = new Contact(
			'foo',
			'bar',
			'Foo Pty Ltd',
			'Suite 1',
			'Level 1',
			'Foo Street',
			'foobar',
			'state',
			new Country('AU'),
			'postcode',
			new Phone('+61.111111111'),
			new Email('foo@example.com'),
			new Phone('+61.111111112')
		);
	}

	public function testCommand()
	{
		$command = new UpdateContactCommand(
			$this->domain,
			$this->contact,
			$this->contact,
			$this->contact,
			$this->contact
		);
		$build = $command->getRequestData();

		$this->assertTrue(is_array($build));
		$this->assertArrayHasKey('domainName', $build);
		$this->assertEquals('example.com', $build['domainName']);

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
		$this->assertEquals('state', $build['registrant_state']);
		$this->assertArrayHasKey('registrant_country', $build);
		$this->assertEquals('AU', $build['registrant_country']);
		$this->assertArrayHasKey('registrant_postcode', $build);
		$this->assertEquals('postcode', $build['registrant_postcode']);
		$this->assertArrayHasKey('registrant_phone', $build);
		$this->assertEquals('+61.111111111', $build['registrant_phone']);
		$this->assertArrayHasKey('registrant_fax', $build);
		$this->assertEquals('+61.111111112', $build['registrant_fax']);
		$this->assertArrayHasKey('registrant_email', $build);
		$this->assertEquals('foo@example.com', $build['registrant_email']);

		$this->assertArrayHasKey('billing_firstname', $build);
		$this->assertEquals('foo', $build['billing_firstname']);
		$this->assertArrayHasKey('billing_lastname', $build);
		$this->assertEquals('bar', $build['billing_lastname']);
		$this->assertArrayHasKey('billing_organisation', $build);
		$this->assertEquals('Foo Pty Ltd', $build['billing_organisation']);
		$this->assertArrayHasKey('billing_address', $build);
		$this->assertTrue(is_array($build['billing_address']));
		$this->assertArrayHasKey(0, $build['billing_address']);
		$this->assertEquals('Suite 1', $build['billing_address'][0]);
		$this->assertArrayHasKey(1, $build['billing_address']);
		$this->assertEquals('Level 1', $build['billing_address'][1]);
		$this->assertArrayHasKey(2, $build['billing_address']);
		$this->assertEquals('Foo Street', $build['billing_address'][2]);
		$this->assertArrayHasKey('billing_suburb', $build);
		$this->assertEquals('foobar', $build['billing_suburb']);
		$this->assertArrayHasKey('billing_state', $build);
		$this->assertEquals('state', $build['billing_state']);
		$this->assertArrayHasKey('billing_country', $build);
		$this->assertEquals('AU', $build['billing_country']);
		$this->assertArrayHasKey('billing_postcode', $build);
		$this->assertEquals('postcode', $build['billing_postcode']);
		$this->assertArrayHasKey('billing_phone', $build);
		$this->assertEquals('+61.111111111', $build['billing_phone']);
		$this->assertArrayHasKey('billing_fax', $build);
		$this->assertEquals('+61.111111112', $build['billing_fax']);
		$this->assertArrayHasKey('billing_email', $build);
		$this->assertEquals('foo@example.com', $build['billing_email']);

		$this->assertArrayHasKey('admin_firstname', $build);
		$this->assertEquals('foo', $build['admin_firstname']);
		$this->assertArrayHasKey('admin_lastname', $build);
		$this->assertEquals('bar', $build['admin_lastname']);
		$this->assertArrayHasKey('admin_organisation', $build);
		$this->assertEquals('Foo Pty Ltd', $build['admin_organisation']);
		$this->assertArrayHasKey('admin_address', $build);
		$this->assertTrue(is_array($build['admin_address']));
		$this->assertArrayHasKey(0, $build['admin_address']);
		$this->assertEquals('Suite 1', $build['admin_address'][0]);
		$this->assertArrayHasKey(1, $build['admin_address']);
		$this->assertEquals('Level 1', $build['admin_address'][1]);
		$this->assertArrayHasKey(2, $build['admin_address']);
		$this->assertEquals('Foo Street', $build['admin_address'][2]);
		$this->assertArrayHasKey('admin_suburb', $build);
		$this->assertEquals('foobar', $build['admin_suburb']);
		$this->assertArrayHasKey('admin_state', $build);
		$this->assertEquals('state', $build['admin_state']);
		$this->assertArrayHasKey('admin_country', $build);
		$this->assertEquals('AU', $build['admin_country']);
		$this->assertArrayHasKey('admin_postcode', $build);
		$this->assertEquals('postcode', $build['admin_postcode']);
		$this->assertArrayHasKey('admin_phone', $build);
		$this->assertEquals('+61.111111111', $build['admin_phone']);
		$this->assertArrayHasKey('admin_fax', $build);
		$this->assertEquals('+61.111111112', $build['admin_fax']);
		$this->assertArrayHasKey('admin_email', $build);
		$this->assertEquals('foo@example.com', $build['admin_email']);

		$this->assertArrayHasKey('technical_firstname', $build);
		$this->assertEquals('foo', $build['technical_firstname']);
		$this->assertArrayHasKey('technical_lastname', $build);
		$this->assertEquals('bar', $build['technical_lastname']);
		$this->assertArrayHasKey('technical_organisation', $build);
		$this->assertEquals('Foo Pty Ltd', $build['technical_organisation']);
		$this->assertArrayHasKey('technical_address', $build);
		$this->assertTrue(is_array($build['technical_address']));
		$this->assertArrayHasKey(0, $build['technical_address']);
		$this->assertEquals('Suite 1', $build['technical_address'][0]);
		$this->assertArrayHasKey(1, $build['technical_address']);
		$this->assertEquals('Level 1', $build['technical_address'][1]);
		$this->assertArrayHasKey(2, $build['technical_address']);
		$this->assertEquals('Foo Street', $build['technical_address'][2]);
		$this->assertArrayHasKey('technical_suburb', $build);
		$this->assertEquals('foobar', $build['technical_suburb']);
		$this->assertArrayHasKey('technical_state', $build);
		$this->assertEquals('state', $build['technical_state']);
		$this->assertArrayHasKey('technical_country', $build);
		$this->assertEquals('AU', $build['technical_country']);
		$this->assertArrayHasKey('technical_postcode', $build);
		$this->assertEquals('postcode', $build['technical_postcode']);
		$this->assertArrayHasKey('technical_phone', $build);
		$this->assertEquals('+61.111111111', $build['technical_phone']);
		$this->assertArrayHasKey('technical_fax', $build);
		$this->assertEquals('+61.111111112', $build['technical_fax']);
		$this->assertArrayHasKey('technical_email', $build);
		$this->assertEquals('foo@example.com', $build['technical_email']);
	}
}
