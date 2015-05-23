<?php  namespace SynergyWholesale\Types; 

use SynergyWholesale\Exception\InvalidArgumentException;

class AuPostCode
{
	private $postcode;

	function __construct($postcode)
	{
		if (!is_scalar($postcode) OR !is_numeric($postcode) OR strlen(strval($postcode)) != 4)
		{
			throw new InvalidArgumentException("Invalid postcode [{$postcode}]");
		}
		$this->postcode = strval($postcode);
	}

	public function getPostcode()
	{
		return $this->postcode;
	}

	public function __toString()
	{
		return $this->getPostcode();
	}

	public function equals(AuPostCode $other)
	{
		return $this->postcode === $other->postcode;
	}
}
