<?php  namespace SynergyWholesale\Types; 

use SynergyWholesale\Exception\InvalidArgumentException;

class RegistrationYears
{
	private $years;

	function __construct($years)
	{
		if (empty($years) OR !is_numeric($years) OR is_float($years) OR $years < 1 OR $years > 10)
		{
			throw new InvalidArgumentException("Years parameter is required and should be a positive integer value");
		}

		$this->years = intval($years);
	}

	public function getYears()
	{
		return $this->years;
	}

	public function __toString()
	{
		return strval($this->years);
	}

	public function equals(RegistrationYears $other)
	{
		return $this->years === $other->years;
	}
}
