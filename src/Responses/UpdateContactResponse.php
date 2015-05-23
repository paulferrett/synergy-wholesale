<?php  namespace SynergyWholesale\Responses;

class UpdateContactResponse extends Response
{
	public function updateSuccessful()
	{
		// if we got this far, it means the update did succeed
		return true;
	}
}
