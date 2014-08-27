<?php  namespace SynergyWholesale\Commands;

use SynergyWholesale\Types\DnsConfiguration;
use SynergyWholesale\Types\Domain;
use SynergyWholesale\Types\DomainList;

class UpdateNameServersCommandTest extends \PHPUnit_Framework_TestCase
{
	public function testCommand()
	{
		$command = new UpdateNameServersCommand(
			new Domain('example.com'),
			new DomainList(array('ns1.foo.com', 'ns2.foo.com')),
			DnsConfiguration::CUSTOM()
		);
		$build = $command->getRequestData();

		$this->assertTrue(is_array($build));
		$this->assertArrayHasKey('domainName', $build);
		$this->assertEquals('example.com', $build['domainName']);
		$this->assertArrayHasKey('nameServers', $build);
		$this->assertArrayHasKey(0, $build['nameServers']);
		$this->assertEquals('ns1.foo.com', $build['nameServers'][0]);
		$this->assertArrayHasKey(1, $build['nameServers']);
		$this->assertEquals('ns2.foo.com', $build['nameServers'][1]);
		$this->assertArrayHasKey('dnsConfigType', $build);
		$this->assertEquals(DnsConfiguration::CUSTOM_NAME_SERVERS, $build['dnsConfigType']);
	}
}

?>
 