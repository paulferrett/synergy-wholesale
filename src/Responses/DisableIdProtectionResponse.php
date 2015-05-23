<?php  namespace SynergyWholesale\Responses; 

class DisableIdProtectionResponse extends Response
{
	public function disableSuccessful()
	{
		// if we got this far, it means the enable did succeed
		return true;
	}
}
