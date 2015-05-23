<?php  namespace SynergyWholesale\Responses;

use SynergyWholesale\Exception\BadDataException;

class CanRenewDomainResponse extends Response
{
	protected $successStatus = array('OK_RENEW', 'OK_NO_RENEWAL');

	protected function validateData()
	{

		if ($this->response->status == 'OK_RENEW' AND isset($this->response->yearsCanRenewFor) AND !is_numeric($this->response->yearsCanRenewFor))
		{
			throw new BadDataException("Expected a numeric value for yearsCanRenewFor");
		}
	}

	public function isRenewable()
	{
		return $this->response->status == 'OK_RENEW';
	}

	public function getYearsCanRenewFor()
	{
		if (isset($this->response->yearsCanRenewFor))
		{
			return intval($this->response->yearsCanRenewFor);
		}
	}
}
