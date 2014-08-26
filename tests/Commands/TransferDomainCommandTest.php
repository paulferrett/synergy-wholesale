<?php  namespace SynergyWholesale\Commands;

use SynergyWholesale\Types\Bool;
use SynergyWholesale\Types\Email;
use SynergyWholesale\Types\Phone;
use SynergyWholesale\Types\Domain;
use SynergyWholesale\Types\Contact;
use SynergyWholesale\Types\Country;

class TransferDomainCommandTest extends \PHPUnit_Framework_TestCase
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

	public function testBadAuthInfo()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'authInfo parameter is required');

		new TransferDomainCommand(
			$this->domain,
			null,
			$this->contact
		);
	}

	public function testBadAuthInfo2()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'authInfo parameter is required');

		$command = new TransferDomainCommand(
			$this->domain,
			"",
			$this->contact
		);
	}

	public function testCommand()
	{
		$command = new TransferDomainCommand(
			$this->domain,
			"foo",
			$this->contact,
			Bool::true(),
			Bool::false()
		);
		$build = $command->getRequestData();

		$this->assertTrue(is_array($build));
		$this->assertArrayHasKey('domainName', $build);
		$this->assertEquals('example.com', $build['domainName']);
		$this->assertArrayHasKey('authInfo', $build);
		$this->assertEquals('foo', $build['authInfo']);

		$this->assertArrayHasKey('firstname', $build);
		$this->assertEquals('foo', $build['firstname']);
		$this->assertArrayHasKey('lastname', $build);
		$this->assertEquals('bar', $build['lastname']);
		$this->assertArrayHasKey('organisation', $build);
		$this->assertEquals('Foo Pty Ltd', $build['organisation']);
		$this->assertArrayHasKey('address', $build);
		$this->assertTrue(is_array($build['address']));
		$this->assertArrayHasKey(0, $build['address']);
		$this->assertEquals('Suite 1', $build['address'][0]);
		$this->assertArrayHasKey(1, $build['address']);
		$this->assertEquals('Level 1', $build['address'][1]);
		$this->assertArrayHasKey(2, $build['address']);
		$this->assertEquals('Foo Street', $build['address'][2]);
		$this->assertArrayHasKey('suburb', $build);
		$this->assertEquals('foobar', $build['suburb']);
		$this->assertArrayHasKey('state', $build);
		$this->assertEquals('state', $build['state']);
		$this->assertArrayHasKey('country', $build);
		$this->assertEquals('AU', $build['country']);
		$this->assertArrayHasKey('postcode', $build);
		$this->assertEquals('postcode', $build['postcode']);
		$this->assertArrayHasKey('phone', $build);
		$this->assertEquals('+61.111111111', $build['phone']);
		$this->assertArrayHasKey('fax', $build);
		$this->assertEquals('+61.111111112', $build['fax']);
		$this->assertArrayHasKey('email', $build);
		$this->assertEquals('foo@example.com', $build['email']);

		$this->assertArrayHasKey('idProtect', $build);
		$this->assertEquals('Y', $build['idProtect']);
		$this->assertArrayHasKey('doRenewal', $build);
		$this->assertEquals('0', $build['doRenewal']);
	}
}

?>
 