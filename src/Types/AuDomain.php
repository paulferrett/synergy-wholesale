<?php  namespace SynergyWholesale\Types; 

use SynergyWholesale\Exception\InvalidArgumentException;

class AuDomain extends Domain
{
	public function __construct($name)
	{
		if (substr(strtolower($name), -3) != '.au')
		{
			throw new InvalidArgumentException("Invalid domain name [{$name}] - must be a .au domain");
		}

		parent::__construct($name);
	}
}
