<?php namespace SynergyWholesale\Commands;

use Hampel\Validate\Validator;
use SynergyWholesale\Exception\InvalidArgumentException;

class DomainInfoCommand implements Command
{
	protected $domainName;

	public function __construct($domainName)
	{
		$validator = new Validator();
		if (!$validator->isDomain($domainName, $validator->getTlds()))
		{
			throw new InvalidArgumentException("Invalid domain name [{$domainName}]");
		}

		$this->domainName = $domainName;
	}

	public function getRequestData()
	{
		return array('domainName' => $this->domainName);
	}
}

?>
