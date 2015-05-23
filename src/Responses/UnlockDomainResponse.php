<?php  namespace SynergyWholesale\Responses; 

class UnlockDomainResponse extends Response
{
	public function unlockSuccessful()
	{
		// if we got this far, it means the unlock did succeed
		return true;
	}
}
