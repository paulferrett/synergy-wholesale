<?php  namespace SynergyWholesale\Commands; 

use SynergyWholesale\Types\UsDomain;

class GetUsNexusDataTest extends \PHPUnit_Framework_TestCase
{
	public function testCommand()
	{
		$command = new GetUsNexusDataCommand(new UsDomain('example.us'));
		$build = $command->getRequestData();

		$this->assertTrue(is_array($build));
		$this->assertArrayHasKey('domainName', $build);
		$this->assertEquals('example.us', $build['domainName']);
	}
}

?>
 