<?php  namespace SynergyWholesale\Responses; 

class EnableIdProtectionResponse extends Response
{
	public function enableSuccessful()
	{
		// if we got this far, it means the enable did succeed
		return true;
	}
}

?>
 