<?php namespace Hampel\SynergyWholesale\Commands;

class DomainInfoCommand implements CommandInterface
{
	protected $domainName;

	public function __construct($domainName)
	{
		$this->domainName = $domainName;
	}

	public function getRequestData()
	{
		return array('domainName' => $this->domainName);
	}
}

?>
