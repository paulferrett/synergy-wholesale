<?php  namespace Hampel\SynergyWholesale\Responses;

use stdClass;
use Hampel\SynergyWholesale\Exception\ResponseErrorException;

class DomainInfoResponse extends Response
{
	protected $expectedFields = array(
		'domainName', 'domain_status', 'domain_expiry',
		'nameServers', 'dnsConfigName',	'domainPassword',
		'bulkInProgress', 'idProtect', 'autoRenew',
		'icannStatus'
	);

	public function __construct(stdClass $response, $command)
	{
		if ($response->status != 'OK')
		{
			throw new ResponseErrorException($response, $command);
		}

		parent::__construct($response, $command);
	}

	public function getExpiry()
	{
		return $this->response->domain_expiry;
	}
}

?>
