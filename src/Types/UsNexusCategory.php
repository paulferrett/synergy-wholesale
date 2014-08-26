<?php  namespace SynergyWholesale\Types;

use SynergyWholesale\Exception\UnknownNexusCategoryException;

class UsNexusCategory
{
	private $nexusCategory;

	public static $nexusCategories = array(
		'C11' => 'US Citizen',
		'C12' => 'Permanent Resident',
		'C21' => 'US Organisation',
		'C31' => 'Foreign organisation doing business in US',
		'C32' => 'Foreign organisation with US office'
	);

	function __construct($nexusCategory)
	{
		if (!array_key_exists($nexusCategory, static::$nexusCategories))
		{
			throw new UnknownNexusCategoryException("Unknown nexus category [{$nexusCategory}]");
		}
		$this->nexusCategory = $nexusCategory;
	}

	public function getNexusCategory()
	{
		return $this->nexusCategory;
	}

	public function getNexusCategoryDescription()
	{
		return self::$nexusCategories[$this->getNexusCategory()];
	}

	public function __toString()
	{
		return $this->getNexusCategoryDescription();
	}
}

?>
 