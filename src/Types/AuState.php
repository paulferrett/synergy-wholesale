<?php  namespace SynergyWholesale\Types;

use SynergyWholesale\Exception\UnknownStateException;

class AuState
{
	private $state;

	public static $states = array('NSW', 'VIC', 'QLD', 'TAS', 'ACT', 'SA', 'WA', 'NT');

	public function __construct($state)
	{
		$state = strtoupper($state);
		if (!in_array($state, static::$states))
		{
			throw new UnknownStateException("Unknown state [{$state}]");
		}
		$this->state = $state;
	}

	public function getState()
	{
		return $this->state;
	}

	public function __toString()
	{
		return $this->getState();
	}

	public function equals(AuState $other)
	{
		return $this->state === $other->state;
	}
}
