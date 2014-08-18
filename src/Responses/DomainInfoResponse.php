<?php  namespace Hampel\SynergyWholesale\Responses;

class DomainInfoResponse extends Response
{
	protected $expectedFields = array(
		'domainName', 'domain_status', 'domain_expiry',
		'nameServers', 'dnsConfigName',	'domainPassword',
		'bulkInProgress', 'idProtect', 'autoRenew',
		'icannStatus'
	);

	public function validateData(){}

	public function getExpiry()
	{
		return $this->response->domain_expiry;
	}
}

?>
