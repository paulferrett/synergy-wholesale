<?php  namespace SynergyWholesale\Types; 

use ReflectionClass;
use SynergyWholesale\Exception\UnknownDnsConfigurationException;

class DnsConfiguration
{
	const CUSTOM_NAME_SERVERS = 1;
	const EMAIL_WEB_FORWARDING = 2;
	const PARKED = 3;
	const DNS_HOSTING = 4;

	private static $constants;

	private $config;

	public function __construct($config)
	{
		if (!isset(static::$constants))
		{
			static::$constants = (new ReflectionClass(get_called_class()))->getConstants();
		}

		if (!in_array($config, array_values(static::$constants)))
		{
			throw new UnknownDnsConfigurationException("Unknown DNS Configuration [{$config}]");
		}
		$this->config = $config;
	}

	public function getConfig()
	{
		return $this->config;
	}

	public function __toString()
	{
		return strval($this->config);
	}

	public static function CUSTOM()
	{
		return new static(self::CUSTOM_NAME_SERVERS);
	}

	public static function FORWARDING()
	{
		return new static(self::EMAIL_WEB_FORWARDING);
	}

	public static function PARKED()
	{
		return new static(self::PARKED);
	}

	public static function HOSTING()
	{
		return new static(self::DNS_HOSTING);
	}

	public function equals(DnsConfiguration $other)
	{
		return $this->config === $other->config;
	}
}
