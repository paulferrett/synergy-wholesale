<?php  namespace SynergyWholesale\Commands;

use SynergyWholesale\Types\Domain;
use SynergyWholesale\Exception\InvalidArgumentException;
use SynergyWholesale\Types\RegistrationYears;

class RenewDomainCommand implements Command
{
	protected $domainName;

	protected $years;

	function __construct(
		Domain $domainName,
		RegistrationYears $years
	)
	{
		$this->domainName = $domainName;
		$this->years = $years;
	}

	public function getRequestData()
	{
		return array(
			'domainName' => $this->domainName->getName(),
			'years' => $this->years->getYears(),
		);
	}
}

?>
 