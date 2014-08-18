<?php namespace SynergyWholesale\Commands;

class BulkCheckDomainCommand extends Command
{
	protected $command = 'bulkcheckDomain';

	protected $domainList;

	public function __construct(array $domainList)
	{
		$this->domainList = $domainList;
	}

	public function buildRequest()
	{
		return array('domainList' => $this->domainList);
	}
}

?>
