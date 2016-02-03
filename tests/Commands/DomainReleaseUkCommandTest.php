<?php  namespace SynergyWholesale\Commands;

use SynergyWholesale\Types\UkDomain;

class DomainReleaseUkCommandTest extends \PHPUnit_Framework_TestCase
{
	public function testCommand()
	{
		$command = new DomainReleaseUKCommand(new UkDomain('example.uk'), 'foo');
		$build = $command->getRequestData();

		$this->assertTrue(is_array($build));
		$this->assertArrayHasKey('domainName', $build);
		$this->assertEquals('example.uk', $build['domainName']);
		$this->assertArrayHasKey('tagName', $build);
		$this->assertEquals('foo', $build['tagName']);
	}
}
