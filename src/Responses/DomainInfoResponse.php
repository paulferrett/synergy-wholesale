<?php  namespace SynergyWholesale\Responses;

use SynergyWholesale\Types\Bool;
use SynergyWholesale\Types\Domain;
use SynergyWholesale\Types\DomainList;
use SynergyWholesale\Types\DnsConfiguration;
use SynergyWholesale\Exception\BadDataException;
use SynergyWholesale\Exception\InvalidArgumentException;
use SynergyWholesale\Exception\UnknownDnsConfigurationException;

class DomainInfoResponse extends Response
{
	protected $expectedFields = array(
		'domainName', 'domain_status', 'domain_expiry',
		'nameServers', 'dnsConfig', 'dnsConfigName',
		'domainPassword', 'bulkInProgress', 'idProtect',
		'autoRenew', 'icannStatus', 'icannVerificationDateEnd'
	);

	/** @var Domain */
	protected $domain;

	/** @var DomainList */
	protected $nameServers;

	protected function validateData()
	{
		if (!is_array($this->response->nameServers))
		{
			$message = "nameServers should be an array";
			throw new BadDataException($message, $this->command, $this->response);
		}

		try
		{
			$this->domain = new Domain($this->response->domainName);
			if (!empty($this->response->nameServers))
			{
				$this->nameServers = new DomainList($this->response->nameServers);
			}
		}
		catch (InvalidArgumentException $e)
		{
			throw new BadDataException($e->getMessage(), $this->command, $this->response);
		}

		if ($this->domain->getTopLevelDomain() == 'au')
		{
			if (!isset($this->response->auRegistrantID))
			{
				$message = "Expected property auRegistrantID missing from response data";
				throw new BadDataException($message, $this->command, $this->response);
			}

			if (!isset($this->response->auRegistrantIDType))
			{
				$message = "Expected property auRegistrantIDType missing from response data";
				throw new BadDataException($message, $this->command, $this->response);
			}
		}

		try
		{
			new DnsConfiguration($this->response->dnsConfig);
		}
		catch (UnknownDnsConfigurationException $e)
		{
			throw new BadDataException($e->getMessage(), $this->command, $this->response);
		}
	}

	/**
	 * @return Domain
	 */
	public function getDomain()
	{
		return $this->domain;
	}

	/**
	 * @return string domain name
	 */
	public function getDomainName()
	{
		return $this->response->domainName;
	}

	/**
	 * @return string domain status
	 */
	public function getDomainStatus()
	{
		return $this->response->domain_status;
	}

	/**
	 * @return string domain expiry
	 */
	public function getDomainExpiry()
	{
		return $this->response->domain_expiry;
	}

	/**
	 * @return string[] array of name server strings
	 */
	public function getNameServers()
	{
		if (isset($this->nameServers))
		{
			return $this->nameServers->getDomainNames();
		}
	}

	/**
	 * @return Domain[] array of Domain types
	 */
	public function getNameServerList()
	{
		if (isset($this->nameServers))
		{
			return $this->nameServers->getDomainList();
		}
	}

	public function getDnsConfig()
	{
		return $this->response->dnsConfig;
	}

	public function getDnsConfigName()
	{
		return $this->response->dnsConfigName;
	}

	public function getDomainPassword()
	{
		return $this->response->domainPassword;
	}

	public function isBulkInProgress()
	{
		return Bool::convert($this->response->bulkInProgress);
	}

	public function isIdProtected()
	{
		return Bool::convert($this->response->idProtect);
	}

	public function isAutoRenewEnabled()
	{
		return Bool::convert($this->response->autoRenew);
	}

	public function getAuRegistrantIdType()
	{
		if (isset($this->response->auRegistrantIDType))
		{
			return $this->response->auRegistrantIDType;
		}
	}

	public function getAuRegistrantId()
	{
		if (isset($this->response->auRegistrantID))
		{
			return $this->response->auRegistrantID;
		}
	}

	public function getIcannStatus()
	{
		return $this->response->icannStatus;
	}

	public function getIcannVerificationDateEnd()
	{
		return $this->response->icannVerificationDateEnd;
	}
}
