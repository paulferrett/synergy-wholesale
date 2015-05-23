<?php  namespace SynergyWholesale\Responses;

use SynergyWholesale\Types\Email;
use SynergyWholesale\Exception\BadDataException;
use SynergyWholesale\Exception\InvalidArgumentException;

class ResendTransferEmailResponse extends Response
{
	protected $expectedFields = array('newEmail');

	protected function validateData()
	{
		try
		{
			$email = new Email($this->response->newEmail);
		}
		catch (InvalidArgumentException $e)
		{
			throw new BadDataException("Response parameter newEmail should contain an email address");
		}
	}

	public function getNewEmail()
	{
		return $this->response->newEmail;
	}
}
