<?php  namespace SynergyWholesale\Commands;

use SynergyWholesale\Types\Domain;
use SynergyWholesale\Types\DomainList;
use SynergyWholesale\Types\DnsConfiguration;

class UpdateNameServersCommand implements Command
{
	/** @var \SynergyWholesale\Types\Domain */
	protected $domainName;

	/** @var \SynergyWholesale\Types\DomainList */
	protected $nameServers;

	/** @var \SynergyWholesale\Types\DnsConfiguration */
	protected $dnsConfigType;

	function __construct(
		Domain $domainName,
		DomainList $nameServers,
		DnsConfiguration $dnsConfigType = null
	)
	{
		$this->domainName = $domainName;
		$this->nameServers = $nameServers;
		$this->dnsConfigType = $dnsConfigType;
	}

	public function getRequestData()
	{
		return array(
			'domainName' => $this->domainName->getName(),
			'nameServers' => $this->nameServers->getDomainNames(),
			'dnsConfigType' => $this->dnsConfigType->getConfig()
		);
	}
}
