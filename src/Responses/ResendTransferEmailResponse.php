<?php  namespace SynergyWholesale\Responses;

use Hampel\Validate\Validator;
use SynergyWholesale\Exception\BadDataException;

class ResendTransferEmailResponse extends Response
{
	protected $expectedFields = array('newEmail');

	protected function validateData()
	{
		$validator = new Validator();
		if (!$validator->isEmail($this->response->newEmail))
		{
			throw new BadDataException("Response parameter newEmail should contain an email address");
		}
	}

	public function getNewEmail()
	{
		return $this->response->newEmail;
	}
}

?>
 