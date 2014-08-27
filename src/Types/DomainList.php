<?php  namespace SynergyWholesale\Types;

use SynergyWholesale\Exception\InvalidArgumentException;

class DomainList
{
	private $domainList;

	public function __construct(array $domainList)
	{
		if (empty($domainList))
		{
			throw new InvalidArgumentException("Expected an array of domain names");
		}

		foreach ($domainList as $domain)
		{
			if ($domain instanceof Domain)
			{
				$this->domainList[] = $domain;
			}
			else
			{
				$this->domainList[] = new Domain($domain);
			}
		}
	}

	public function getDomainList()
	{
		return $this->domainList;
	}

	public function getDomainNames()
	{
		return array_map(function($domain)
		{
			return strval($domain);
		}, $this->domainList);
	}

	public function __toString()
	{
		return implode(', ', $this->domainList);
	}
}

?>
 