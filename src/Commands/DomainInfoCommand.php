<?php namespace SynergyWholesale\Commands;

use SynergyWholesale\Types\Domain;

class DomainInfoCommand implements Command
{
	protected $domain;

	public function __construct(Domain $domain)
	{
		$this->domain = $domain;
	}

	public function getRequestData()
	{
		return array('domainName' => $this->domain->getName());
	}
}

?>
