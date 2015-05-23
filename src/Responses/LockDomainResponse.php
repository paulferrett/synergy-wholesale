<?php  namespace SynergyWholesale\Responses;

class LockDomainResponse extends Response
{
	public function lockSuccessful()
	{
		// if we got this far, it means the lock did succeed
		return true;
	}
}
