<?php  namespace SynergyWholesale\Types;

use SynergyWholesale\Exception\InvalidArgumentException;

class UkDomain extends Domain
{
	public function __construct($name)
	{
		if (substr(strtolower($name), -3) != '.uk')
		{
			throw new InvalidArgumentException("Invalid domain name [{$name}] - must be a .uk domain");
		}

		parent::__construct($name);
	}
}
