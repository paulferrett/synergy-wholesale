<?php namespace SynergyWholesale\Commands;

use SynergyWholesale\Types\Domain;
use SynergyWholesale\Exception\InvalidArgumentException;

class BulkCheckDomainCommand implements Command
{
	protected $domainList;

	public function __construct(array $domainList)
	{
		if (empty($domainList))
		{
			throw new InvalidArgumentException("Empty domain list passed to BulkCheckDomainCommand");
		}

		foreach ($domainList as $domain)
		{
			if (!$domain instanceof Domain)
			{
				throw new InvalidArgumentException("BulkCheckDomainCommand expects an array of SynergyWholesale\\Types\\Domain objects");
			}
		}
		$this->domainList = $domainList;
	}

	public function getRequestData()
	{
		$domainList = array();
		foreach ($this->domainList as $domain)
		{
			$domainList[] = $domain->getName();
		}

		return array('domainList' => $domainList);
	}
}

?>
