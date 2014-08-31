<?php  namespace SynergyWholesale\Commands;

use SynergyWholesale\Types\Domain;
use SynergyWholesale\Exception\InvalidArgumentException;
use SynergyWholesale\Types\RegistrationYears;

class RenewDomainCommand implements Command
{
	/** @var \SynergyWholesale\Types\Domain */
	protected $domainName;

	/** @var \SynergyWholesale\Types\RegistrationYears */
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
 