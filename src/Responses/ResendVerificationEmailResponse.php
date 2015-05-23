<?php  namespace SynergyWholesale\Responses; 

class ResendVerificationEmailResponse
{
	public function resendSuccessful()
	{
		// if we got this far, it means the resend did succeed
		return true;
	}
}
