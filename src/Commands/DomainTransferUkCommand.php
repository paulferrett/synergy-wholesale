<?php  namespace SynergyWholesale\Commands;

use SynergyWholesale\Types\UkDomain;

class DomainTransferUkCommand implements Command
{
	/** @var \SynergyWholesale\Types\UkDomain */
	protected $domain;

	public function __construct(UkDomain $domain)
	{
		$this->domain = $domain;
	}

	public function getRequestData()
	{
		return array('domainName' => strval($this->domain));
	}
}

?>
 