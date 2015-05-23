<?php  namespace SynergyWholesale\Responses;

class CheckDomainResponse extends Response
{
	protected $successStatus = array('AVAILABLE', 'UNAVAILABLE');

	public function isAvailable()
	{
		return ($this->response->status == 'AVAILABLE');
	}
}
