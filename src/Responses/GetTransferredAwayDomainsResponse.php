<?php  namespace SynergyWholesale\Responses;

class GetTransferredAwayDomainsResponse extends Response
{
	protected $expectedFields = array('domains');

	public function getDomains()
	{
		return $this->response->domains;
	}
}

?>
 