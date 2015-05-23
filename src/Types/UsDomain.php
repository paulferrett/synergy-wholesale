<?php  namespace SynergyWholesale\Types;

use SynergyWholesale\Exception\InvalidArgumentException;

class UsDomain extends Domain
{
	public function __construct($name)
	{
		if (substr(strtolower($name), -3) != '.us')
		{
			throw new InvalidArgumentException("Invalid domain name [{$name}] - must be a .us domain");
		}

		parent::__construct($name);
	}
}
