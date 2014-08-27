<?php namespace SynergyWholesale\Commands;

use SynergyWholesale\Types\Domain;
use SynergyWholesale\Types\DomainPassword;

class UpdateDomainPasswordCommand implements Command
{
	protected $domain;

	protected $newPassword;

	public function __construct(Domain $domain, DomainPassword $newPassword)
	{
		$this->domain = $domain;
		$this->newPassword = $newPassword;
	}

	public function getRequestData()
	{
		return array(
			'domainName' => strval($this->domain),
			'newPassword' => strval($this->newPassword)
		);
	}
}

?>
