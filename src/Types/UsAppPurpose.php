<?php  namespace SynergyWholesale\Types;

use SynergyWholesale\Exception\UnknownAppPurposeException;

class UsAppPurpose
{
	private $appPurpose;

	public static $purposes = array(
		'P1' => "Business for profit",
		'P2' => "Nonprofit",
		'P3' => "Personal",
		'P4' => "Educational",
		'P5' => "Governmental"
	);

	function __construct($appPurpose)
	{
		if (!array_key_exists($appPurpose, static::$purposes))
		{
			throw new UnknownAppPurposeException("Unknown app purpose [{$appPurpose}]");
		}
		$this->appPurpose = $appPurpose;
	}

	public function getAppPurpose()
	{
		return $this->appPurpose;
	}

	public function getAppPurposeDescription()
	{
		return static::$purposes[$this->getAppPurpose()];
	}

	public function __toString()
	{
		return $this->getAppPurposeDescription();
	}
}

?>
 