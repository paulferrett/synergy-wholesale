<?php  namespace SynergyWholesale\Commands;

use SynergyWholesale\Types\Domain;
use SynergyWholesale\Types\RegistrationYears;

class RenewDomainCommandTest extends \PHPUnit_Framework_TestCase
{
	public function testCommand()
	{
		$command = new RenewDomainCommand(
			new Domain('example.com'),
			new RegistrationYears(1)
		);
		$build = $command->getRequestData();

		$this->assertTrue(is_array($build));
		$this->assertArrayHasKey('domainName', $build);
		$this->assertEquals('example.com', $build['domainName']);
		$this->assertArrayHasKey('years', $build);
		$this->assertEquals(1, $build['years']);
	}
}
