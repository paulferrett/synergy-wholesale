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
		$this->assertEquals('CUSTOM_NAME_SERVERS', $config->getConfigName());

		$config = new DnsConfiguration(DnsConfiguration::CUSTOM_NAME_SERVERS);

		$this->assertEquals(DnsConfiguration::CUSTOM_NAME_SERVERS, $config->getConfig());
		$this->assertEquals('CUSTOM_NAME_SERVERS', $config->getConfigName());

		$config = DnsConfiguration::custom();

		$this->assertEquals(DnsConfiguration::CUSTOM_NAME_SERVERS, $config->getConfig());
		$this->assertEquals('CUSTOM_NAME_SERVERS', $config->getConfigName());

		$config = DnsConfiguration::forwarding();

		$this->assertEquals(DnsConfiguration::EMAIL_WEB_FORWARDING, $config->getConfig());
		$this->assertEquals('EMAIL_WEB_FORWARDING', $config->getConfigName());
	}
}

?>
 