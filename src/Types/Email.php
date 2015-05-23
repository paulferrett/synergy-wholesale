<?php  namespace SynergyWholesale\Types; 

use SynergyWholesale\Exception\InvalidArgumentException;

class Email
{
	private $email;

	function __construct($email)
	{
		$filtered = filter_var($email, FILTER_VALIDATE_EMAIL);
		if ($filtered === false)
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

	public function equals(Email $other)
	{
		return $this->email === $other->email;
	}
}
