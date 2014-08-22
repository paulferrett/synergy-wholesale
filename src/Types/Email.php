<?php  namespace SynergyWholesale\Types; 

use Hampel\Validate\Validator;
use SynergyWholesale\Exception\InvalidArgumentException;

class Email
{
	private $email;

	function __construct($email)
	{
		$validator = new Validator();
		if (!$validator->isEmail($email))
		{
			throw new InvalidArgumentException("Invalid email address [{$email}]");
		}

		$this->email = $email;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function __toString()
	{
		return $this->getEmail();
	}
}

?>
 