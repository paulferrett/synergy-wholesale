<?php  namespace SynergyWholesale\Types; 

use SynergyWholesale\Exception\InvalidArgumentException;

class Tld
{
	private $tld;

	public function __construct($tld)
	{
		$tld = ltrim(strtolower($tld), '.');

		$parts = explode('.', $tld);
		if (count($parts) > 2)
		{
			throw new InvalidArgumentException("Invalid Top Level Domain [{$tld}] - should have no more than 2 parts");
		}

		if (count($parts) == 2 AND strlen($parts[1]) > 2)
		{
			throw new InvalidArgumentException("Invalid Top Level Domain [{$tld}] - Country Codes have a maximum of 2 characters");
		}

		$tld_part = array_shift($parts);

		if (!preg_match('/^xn--[a-z0-9\-]{2,63}|[a-z]{2,63}$/ix', $tld_part))
		{
			throw new InvalidArgumentException("Invalid Top Level Domain [{$tld}]");
		}

		$this->tld = $tld;
	}

	public function getTld()
	{
		return $this->tld;
	}

	public function isCcTld()
	{
		$parts = $this->getParts();
		return $this->isTwoCharPart(array_pop($parts));
	}

	public function getCcTld()
	{
		if ($this->isCcTld())
		{
			$parts = $this->getParts();
			return array_pop($parts);
		}
	}

	public function __toString()
	{
		return $this->getTld();
	}

	public function equals(Tld $other)
	{
		return $this->tld === $other->tld;
	}

	protected function getParts()
	{
		return explode('.', $this->tld);
	}

	protected function isTwoCharPart($part)
	{
		return strlen($part) == 2;
	}
}
