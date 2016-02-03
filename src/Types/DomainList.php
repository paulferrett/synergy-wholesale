<?php  namespace SynergyWholesale\Types;

use SynergyWholesale\Exception\InvalidArgumentException;

class DomainList
{
	/** @var Domain[] $domainList */
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

	/**
	 * @return Domain[] array of Domain objects representing name servers
	 */
	public function getDomainList()
	{
		return $this->domainList;
	}

	/**
	 * @return array (string) array of name server strings
	 */
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
