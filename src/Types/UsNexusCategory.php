<?php  namespace SynergyWholesale\Types;

use ReflectionClass;
use SynergyWholesale\Exception\UnknownNexusCategoryException;

class UsNexusCategory
{
	const US_CITIZEN = 'C11';
	const PERMANENT_RESIDENT = 'C12';
	const US_ORGANISATION = 'C21';
	const FOREIGN_ORGANISATION = 'C31';
	const FOREIGN_ORGANISATION_US_OFFICE = 'C32';

	private $nexusCategory;

	private static $constants;

	function __construct($nexusCategory)
	{
		if (!isset(static::$constants))
		{
			static::$constants = (new ReflectionClass(get_called_class()))->getConstants();
		}

		if (!in_array($nexusCategory, array_values(static::$constants)))
		{
			throw new UnknownNexusCategoryException("Unknown nexus category [{$nexusCategory}]");
		}
		$this->nexusCategory = $nexusCategory;
	}

	public function getNexusCategory()
	{
		return $this->nexusCategory;
	}

	public function __toString()
	{
		return $this->nexusCategory;
	}

	public function equals(UsNexusCategory $other)
	{
		return $this->nexusCategory === $other->nexusCategory;
	}

	public static function US_CITIZEN()
	{
		return new static(self::US_CITIZEN);
	}

	public static function PERMANENT_RESIDENT()
	{
		return new static(self::PERMANENT_RESIDENT);
	}

	public static function US_ORGANISATION()
	{
		return new static(self::US_ORGANISATION);
	}

	public static function FOREIGN_ORGANISATION()
	{
		return new static(self::FOREIGN_ORGANISATION);
	}

	public static function FOREIGN_ORGANISATION_US_OFFICE()
	{
		return new static(self::FOREIGN_ORGANISATION_US_OFFICE);
	}
}
