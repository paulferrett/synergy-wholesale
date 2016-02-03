<?php  namespace SynergyWholesale\Responses;

use SynergyWholesale\Exception\InvalidArgumentException;
use SynergyWholesale\Types\Domain;
use SynergyWholesale\Exception\BadDataException;

class BulkCheckDomainResponse extends Response
{
	protected $expectedFields = array('domainList');

	protected function validateData()
	{
		if (empty($this->response->domainList) OR !is_array($this->response->domainList))
		{
			throw new BadDataException("Empty or invalid domainList found in response");
		}

		foreach ($this->response->domainList as $domain)
		{
			if (!isset($domain->domain))
			{
				throw new BadDataException("Expected property 'domain' not found in response domainList");
			}

			if (!isset($domain->available))
			{
				throw new BadDataException("Expected property 'available' not found in response domainList");
			}

			try
			{
				new Domain($domain->domain);
			}
			catch (InvalidArgumentException $e)
			{
				throw new BadDataException($e->getMessage(), $this->command, $this->response);
			}
		}
	}

	public function getAvailableDomains()
	{
		$domainList = array();

		foreach ($this->response->domainList as $domain)
		{
			$domainList[$domain->domain] = ($domain->available == 1);
		}

		return $domainList;
	}
}
