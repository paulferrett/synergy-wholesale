<?php  namespace SynergyWholesale\Commands;

use SynergyWholesale\Types\Domain;

class ResubmitFailedTransferCommandTest extends \PHPUnit_Framework_TestCase
{
	public function testCommand()
	{
		$command = new ResubmitFailedTransferCommand(
			new Domain('example.com'),
			'foobar'
		);
		$build = $command->getRequestData();

		$this->assertTrue(is_array($build));
		$this->assertArrayHasKey('domainName', $build);
		$this->assertEquals('example.com', $build['domainName']);
		$this->assertArrayHasKey('newPassword', $build);
		$this->assertEquals('foobar', $build['newPassword']);
	}
}
