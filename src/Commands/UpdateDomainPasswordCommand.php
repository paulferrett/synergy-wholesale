<?php namespace SynergyWholesale\Commands;

use SynergyWholesale\Types\Domain;
use SynergyWholesale\Types\DomainPassword;

class UpdateDomainPasswordCommand implements Command
{
	protected $domain;

	protected $password;

	public function __construct(Domain $domain, DomainPassword $password)
	{
		$this->domain = $domain;
		$this->password = $password;
	}

	public function getRequestData()
	{
		return array(
			'domainName' => strval($this->domain),
			'newPassword' => strval($this->password)
		);
	}
}

?>
