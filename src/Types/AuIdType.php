<?php  namespace SynergyWholesale\Types; 

use SynergyWholesale\Exception\UnknownIdTypeException;

class AuIdType
{
	private $idType;

	public static $idTypes = array(
		'ABN',
		'ACN',
		'ACT BN',
		'NSW BN',
		'NT BN',
		'OTHER',
		'QLD BN',
		'SA BN',
		'TAS BN',
		'TM',
		'VIC BN',
		'WA BN'
	);

	public function __construct($idType)
	{
		if (!in_array($idType, static::$idTypes))
		{
			throw new UnknownIdTypeException("Unknown id type [{$idType}]");
		}

		$this->idType = $idType;
	}

	public static function newFromState(AuState $state)
	{
		$state = $state->getState();
		return new static("{$state} BN");
	}

	public static function newAbn()
	{
		return new static('ABN');
	}

	public static function newAcn()
	{
		return new static('ACN');
	}

	public static function newTm()
	{
		return new static('TM');
	}

	public static function newOther()
	{
		return new static('OTHER');
	}

	public function getIdType()
	{
		return $this->idType;
	}

	public function __toString()
	{
		return $this->getIdType();
	}
}

?>
 