<?php  namespace SynergyWholesale\Types; 

use SynergyWholesale\Exception\UnknownDnsConfigurationException;

class DnsConfiguration
{
	const CUSTOM_NAME_SERVERS = 1;
	const EMAIL_WEB_FORWARDING = 2;
	const PARKED = 3;
	const DNS_HOSTING = 4;

	private static $config_types = array(
		self::CUSTOM_NAME_SERVERS => "CUSTOM_NAME_SERVERS",
		self::EMAIL_WEB_FORWARDING => "EMAIL_WEB_FORWARDING",
		self::PARKED => "PARKED",
		self::DNS_HOSTING => "DNS_HOSTING"
	);

	private $config;

	public function __construct($config)
	{
		if (!array_key_exists($config, self::$config_types))
		{
			throw new UnknownDnsConfigurationException("Unknown DNS Configuration [{$config}]");
		}
		$this->config = $config;
	}

	public function getConfig()
	{
		return $this->config;
	}

	public function getConfigName()
	{
		return self::$config_types[$this->config];
	}

	public static function custom()
	{
		return new static(self::CUSTOM_NAME_SERVERS);
	}

	public static function forwarding()
	{
		return new static(self::EMAIL_WEB_FORWARDING);
	}

	public static function parked()
	{
		return new static(self::PARKED);
	}

	public static function hosting()
	{
		return new static(self::DNS_HOSTING);
	}
}

?>
 