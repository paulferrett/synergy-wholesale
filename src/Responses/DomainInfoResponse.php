<?php  namespace SynergyWholesale\Responses;

use SynergyWholesale\Types\Domain;

class DomainInfoResponse extends Response
{
	protected $expectedFields = array(
		'domainName', 'domain_status', 'domain_expiry',
		'nameServers', 'dnsConfig', 'dnsConfigName',
		'domainPassword', 'bulkInProgress', 'idProtect',
		'autoRenew', 'icannStatus', 'icannVerificationDateEnd'
	);

	protected function validateData()
	{
		$domain = new Domain($this->response->domainName);
		if ($domain->getTld() == 'au')
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
	}

	public function getDomainName()
	{
		return $this->response->domainName;
	}

	public function getDomainStatus()
	{
		return $this->response->domain_status;
	}

	public function getDomainExpiry()
	{
		return $this->response->domain_expiry;
	}

	public function getNameServers()
	{
		return $this->response->nameServers;
	}

	public function getDnsConfigType()
	{
		return $this->response->dnsConfig;
	}

	public function getDomainPassword()
	{
		return $this->response->domainPassword;
	}

	public function isBulkInProgress()
	{
		return $this->response->bulkInProgress == 1 ? true : false;
	}

	public function isIdProtected()
	{
		return $this->response->idProtect == 'Enabled' ? true : false;
	}

	public function isAutoRenewEnabled()
	{
		return $this->response->autoRenew == 'on' ? true : false;
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

?>
