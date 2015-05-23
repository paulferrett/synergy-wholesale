<?php  namespace SynergyWholesale\Types; 

use SynergyWholesale\Exception\InvalidArgumentException;

class Domain
{
	private $name;

	/** @var array List of country-code 2nd-level domains supported by Synergy Wholesale */
	public static $secondLevelDomains = array(
		'asn.au',
		'com.au',
		'id.au',
		'net.au',
		'org.au',
		'co.nz',
		'geek.nz',
		'net.nz',
		'org.nz',
		'co.uk',
		'me.uk',
		'org.uk',
	);

	public function __construct($name)
	{
		$name = strtolower($name);

		if (!preg_match('/\b((?=[a-z0-9-]{1,63}\.)(xn--)?[a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,63}\b/ix', $name))
		{
			throw new InvalidArgumentException("Invalid domain name [{$name}]");
		}

		$this->name = $name;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getTopLevelDomain()
	{
		$parts = $this->getParts();
		return array_pop($parts);
	}

	public function getTld()
	{
		return $this->getTopLevelDomain();
	}

	public function isCountyCodeTopLevelDomain()
	{
		return $this->isTwoCharPart($this->getTopLevelDomain());
	}

	public function isCcTld()
	{
		return $this->isCountyCodeTopLevelDomain();
	}

	public function getExtension()
	{
		$parts = $this->getParts();
		$tld = array_pop($parts);

		if (!$this->isTwoCharPart($tld)) return $tld;

		$sld = array_pop($parts);
		$extension = "{$sld}.{$tld}";

		if (in_array($extension, self::$secondLevelDomains)) return $extension;
		else return $tld;
	}

	public function isSecondLevelDomain()
	{
		$extension = $this->getExtension();

		return in_array($extension, self::$secondLevelDomains);
	}

	public function is2ld()
	{
		return $this->isSecondLevelDomain();
	}

	public function getBaseName()
	{
		$minus_extension = $this->stripExtension();

		$parts = explode('.', $minus_extension);
		return array_pop($parts);
	}

	public function isSubDomain()
	{
		$minus_extension = $this->stripExtension();
		return strpos($minus_extension, '.') !== false;
	}

	public function __toString()
	{
		return $this->getName();
	}

	public function equals(Domain $other)
	{
		return $this->name === $other->name;
	}

	protected function getParts()
	{
		return explode('.', $this->name);
	}

	protected function isTwoCharPart($part)
	{
		return strlen($part) == 2;
	}

	protected function stripExtension()
	{
		$extension = "." . $this->getExtension();
		return substr($this->getName(), 0, -strlen($extension));
	}
}
