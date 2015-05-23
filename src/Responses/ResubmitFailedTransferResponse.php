<?php  namespace SynergyWholesale\Responses;

use SynergyWholesale\Types\Email;
use SynergyWholesale\Exception\BadDataException;
use SynergyWholesale\Exception\InvalidArgumentException;

class ResubmitFailedTransferResponse extends Response
{
	protected $expectedFields = array('newEmail', 'costPrice');

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

		if (!is_numeric($this->response->costPrice))
		{
			throw new BadDataException("Expected a numeric cost price");
		}
	}

	public function getCostPrice()
	{
		return $this->response->costPrice;
	}

	public function getNewEmail()
	{
		return $this->response->newEmail;
	}
}
