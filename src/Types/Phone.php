<?php  namespace SynergyWholesale\Types; 

use SynergyWholesale\Exception\InvalidArgumentException;

class Phone
{
	private $phone;

	function __construct($phone)
	{
		// strip all spaces
		$phone = str_replace(' ', '', $phone);

		if (!preg_match('/^\+[0-9]{1,2}\.[0-9]{6,9}$/', $phone))
		{
			throw new InvalidArgumentException("Invalid phone number [{$phone}] - must be in the format +99.999999999");
		}
		$this->phone = $phone;
	}

	public function getPhone()
	{
		return $this->phone;
	}

	public function __toString()
	{
		return $this->getPhone();
	}

	public function equals(Phone $other)
	{
		return $this->phone === $other->phone;
	}
}

?>
 