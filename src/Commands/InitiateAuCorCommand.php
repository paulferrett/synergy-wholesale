<?php  namespace SynergyWholesale\Commands;

use SynergyWholesale\Types\AuDomain;

class InitiateAuCorCommand implements Command
{
	protected $domain;

	public function __construct(AuDomain $domain)
	{
		$this->domain = $domain;
	}

	public function getRequestData()
	{
		return array('domainName' => strval($this->domain));
	}
}

?>
 