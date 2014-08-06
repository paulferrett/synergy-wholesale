<?php namespace Hampel\SynergyWholesale\Commands;

class DomainInfoCommand extends Command
{
	protected $command = 'domainInfo';

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
