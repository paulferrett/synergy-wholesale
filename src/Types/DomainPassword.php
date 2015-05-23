<?php  namespace SynergyWholesale\Types; 

use SynergyWholesale\Exception\LengthException;

class DomainPassword
{
	private $password;

	const MINIMUM_LENGTH = 6;
	const MAXIMUM_LENGTH = 16;

	function __construct($password)
	{
		$length = strlen($password);
		if ($length < self::MINIMUM_LENGTH OR $length > self::MAXIMUM_LENGTH)
		{
			throw new LengthException("Domain passwords should contain between " . self::MINIMUM_LENGTH . " and " . self::MAXIMUM_LENGTH . " characters");
		}
		$this->password = $password;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function __toString()
	{
		return $this->getPassword();
	}

	public function equals(DomainPassword $other)
	{
		return $this->password === $other->password;
	}
}
