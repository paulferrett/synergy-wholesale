<?php  namespace SynergyWholesale\Types; 

use SynergyWholesale\Exception\UnknownCountryException;

class Country
{
	public static $isocodes;

	private $countryCode;

	public function __construct($countryCode)
	{
		$countryCode = strtoupper($countryCode);

		if (!isset(static::$isocodes))
		{
			static::$isocodes = require __DIR__ . '/isocodes.php';
		}

		if (!array_key_exists($countryCode, static::$isocodes))
		{
			throw new UnknownCountryException("Unknown country [{$countryCode}]");
		}
		$this->countryCode = $countryCode;
	}

	public function getCountryCode()
	{
		return $this->countryCode;
	}

	public function getCountryName()
	{
		return self::$isocodes[$this->countryCode];
	}

	public function __toString()
	{
		return $this->getCountryName();
	}

	public function equals(Country $other)
	{
		return $this->countryCode === $other->countryCode;
	}
}

?>
 