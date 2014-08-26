<?php  namespace SynergyWholesale\Types;

class Bool
{
	private $bool;

	function __construct($bool)
	{
		if (is_bool($bool)) $this->bool = $bool;
		elseif (
			strcasecmp($bool, 'y') == 0 OR
			strcasecmp($bool, 'yes') == 0 OR
			strcasecmp($bool, 'on') == 0 OR
			strcasecmp($bool, 't') == 0 OR
			strcasecmp($bool, 'true') == 0 OR
			strcasecmp($bool, 'enabled') == 0 OR
			strcasecmp($bool, '1') == 0
		) $this->bool = true;
		elseif (
			strcasecmp($bool, 'n') == 0 OR
			strcasecmp($bool, 'no') == 0 OR
			strcasecmp($bool, 'off') == 0 OR
			strcasecmp($bool, 'f') == 0 OR
			strcasecmp($bool, 'false') == 0 OR
			strcasecmp($bool, 'disabled') == 0 OR
			strcasecmp($bool, '0') == 0
		) $this->bool = false;
		else $bool = (bool) $bool;
	}

	public function getBool()
	{
		return $this->bool;
	}

	public function isTrue()
	{
		return $this->bool == true;
	}

	public function isFalse()
	{
		return $this->bool == false;
	}

	public function __toString()
	{
		return $this->isTrue() ? 'true' : 'false';
	}

	public static function true()
	{
		return new static(true);
	}

	public static function false()
	{
		return new static(false);
	}
}

?>
 