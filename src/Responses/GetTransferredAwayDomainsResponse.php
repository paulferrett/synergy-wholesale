<?php  namespace SynergyWholesale\Responses;

class GetTransferredAwayDomainsResponse extends Response
{
	public function getDomains()
	{
		if (isset($this->response->domains))
		{
			return $this->response->domains;
		}
	}
}
