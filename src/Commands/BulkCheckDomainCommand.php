<?php namespace SynergyWholesale\Commands;

use SynergyWholesale\Types\DomainList;

class BulkCheckDomainCommand implements Command
{
	/** @var \SynergyWholesale\Types\DomainList $domainList */
	protected $domainList;

	public function __construct(DomainList $domainList)
	{
		$this->domainList = $domainList;
	}

	public function getRequestData()
	{
		return array('domainList' => $this->domainList->getDomainNames());
	}
}

?>
