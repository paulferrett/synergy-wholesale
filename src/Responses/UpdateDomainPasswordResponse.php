<?php  namespace SynergyWholesale\Responses;

class UpdateDomainPasswordResponse extends Response
{
	public function updateSuccessful()
	{
		// if we got this far, it means the update did succeed
		return true;
	}
}
