<?php  namespace SynergyWholesale\Types;

use ReflectionClass;
use SynergyWholesale\Exception\UnknownAppPurposeException;

class UsAppPurpose
{
	const BUSINESS_FOR_PROFIT = 'P1';
	const NONPROFIT = 'P2';
	const PERSONAL = 'P3';
	const EDUCATIONAL = 'P4';
	const GOVERNMENTAL = 'P5';

	private $appPurpose;

	private static $constants;

	function __construct($appPurpose)
	{
		if (!isset(static::$constants))
		{
			static::$constants = (new ReflectionClass(get_called_class()))->getConstants();
		}

		if (!in_array($appPurpose, array_values(static::$constants)))
		{
			throw new UnknownAppPurposeException("Unknown app purpose [{$appPurpose}]");
		}
		$this->appPurpose = $appPurpose;
	}

	public function getAppPurpose()
	{
		return $this->appPurpose;
	}

	public function __toString()
	{
		return $this->appPurpose;
	}

	public function equals(UsAppPurpose $other)
	{
		return $this->appPurpose === $other->appPurpose;
	}

	public static function BUSINESS()
	{
		return new static(self::BUSINESS_FOR_PROFIT);
	}

	public static function NONPROFIT()
	{
		return new static(self::NONPROFIT);
	}

	public static function PERSONAL()
	{
		return new static(self::PERSONAL);
	}

	public static function EDUCATIONAL()
	{
		return new static(self::EDUCATIONAL);
	}

	public static function GOVERNMENTAL()
	{
		return new static(self::GOVERNMENTAL);
	}
}
