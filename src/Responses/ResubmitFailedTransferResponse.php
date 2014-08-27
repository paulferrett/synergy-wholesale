<?php  namespace SynergyWholesale\Responses;

use Hampel\Validate\Validator;
use SynergyWholesale\Exception\BadDataException;

class ResubmitFailedTransferResponse extends Response
{
	protected $expectedFields = array('newEmail', 'costPrice');

	protected function validateData()
	{
		$validator = new Validator();
		if (!$validator->isEmail($this->response->newEmail))
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

?>
 