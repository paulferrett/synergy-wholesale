<?php  namespace SynergyWholesale\Commands;

use SynergyWholesale\Types\Domain;

class ResubmitFailedTransferCommand implements Command
{
	protected $domainName;

	protected $newPassword;

	public function __construct(Domain $domain, $newPassword)
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
 