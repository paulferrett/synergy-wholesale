<?php  namespace SynergyWholesale\Commands;

use SynergyWholesale\Types\Domain;
use SynergyWholesale\Types\DomainPassword;

class UpdateDomainPasswordCommandTest extends \PHPUnit_Framework_TestCase
{
	public function testCommand()
	{
		$command = new UpdateDomainPasswordCommand(
			new Domain('example.com'),
			new DomainPassword('foobar')
		);
		$build = $command->getRequestData();

		$this->assertTrue(is_array($build));
		$this->assertArrayHasKey('domainName', $build);
		$this->assertEquals('example.com', $build['domainName']);
		$this->assertArrayHasKey('newPassword', $build);
		$this->assertEquals('foobar', $build['newPassword']);
	}
}
