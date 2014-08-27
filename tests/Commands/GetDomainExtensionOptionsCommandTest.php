<?php  namespace SynergyWholesale\Commands;

class GetDomainExtensionOptionsCommandTest extends \PHPUnit_Framework_TestCase
{
	public function testBadTld()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'Invalid TLD [example]');

		new GetDomainExtensionOptionsCommand('example');
	}

	public function testCommand()
	{
		$command = new GetDomainExtensionOptionsCommand('.com.au');
		$build = $command->getRequestData();

		$this->assertTrue(is_array($build));
		$this->assertArrayHasKey('tld', $build);
		$this->assertEquals('.com.au', $build['tld']);
	}
}

?>
 