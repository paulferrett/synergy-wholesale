<?php  namespace SynergyWholesale\Types;

class DnsConfigurationTest extends \PHPUnit_Framework_TestCase
{
	public function testUnknownConfig()
	{
		$this->setExpectedException('SynergyWholesale\Exception\UnknownDnsConfigurationException', 'Unknown DNS Configuration [foo]');

		new DnsConfiguration('foo');
	}

	public function testDnsConfig()
	{
		$config = new DnsConfiguration(1);

		$this->assertEquals(1, $config->getConfig());
		$this->assertEquals(1, strval($config));
		$this->assertEquals(DnsConfiguration::CUSTOM_NAME_SERVERS, strval($config));
		$this->assertTrue($config->equals(DnsConfiguration::CUSTOM()));
	}
}
