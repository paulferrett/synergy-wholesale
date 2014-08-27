<?php  namespace SynergyWholesale\Commands;

use SynergyWholesale\Types\AuDomain;

class InitiateAuCorCommandTest extends \PHPUnit_Framework_TestCase
{
	public function testCommand()
	{
		$command = new InitiateAuCorCommand(new AuDomain('example.com.au'));
		$build = $command->getRequestData();

		$this->assertTrue(is_array($build));
		$this->assertArrayHasKey('domainName', $build);
		$this->assertEquals('example.com.au', $build['domainName']);
	}
}

?>
 