<?php  namespace SynergyWholesale\Commands;

use SynergyWholesale\Types\Domain;

class CheckDomainCommandTest extends \PHPUnit_Framework_TestCase
{
	public function testCommand()
	{
		$command = new CheckDomainCommand(new Domain('example.com'));
		$build = $command->getRequestData();

		$this->assertTrue(is_array($build));
		$this->assertArrayHasKey('domainName', $build);
		$this->assertEquals('example.com', $build['domainName']);
	}
}
