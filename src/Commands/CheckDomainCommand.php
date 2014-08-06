<?php namespace Hampel\SynergyWholesale\Commands;

class CheckDomainCommand extends Command
{
	protected $command = 'checkDomain';

	protected $domainName;

	public function __construct($domainName)
	{
		$this->domainName = $domainName;
	}

	public function build()
	{
		return array('domainName' => $this->domainName);
	}
}

?>
