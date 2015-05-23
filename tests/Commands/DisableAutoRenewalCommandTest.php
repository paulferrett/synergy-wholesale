<?php  namespace SynergyWholesale\Commands;

use SynergyWholesale\Types\Domain;

class DisableAutoRenewalCommandTest extends \PHPUnit_Framework_TestCase
{
	public function testCommand()
	{
		$command = new DisableAutoRenewalCommand(new Domain('example.com'));
		$build = $command->getRequestData();

		$this->assertTrue(is_array($build));
		$this->assertArrayHasKey('domainName', $build);
		$this->assertEquals('example.com', $build['domainName']);
	}
}
