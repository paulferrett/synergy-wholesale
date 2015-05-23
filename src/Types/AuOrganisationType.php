<?php  namespace SynergyWholesale\Types; 

use SynergyWholesale\Exception\UnknownOrganisationTypeException;

class AuOrganisationType
{
	private $organisationType;

	public static $organisationTypes = array(
		'Charity',
		'Citizen/Resident',
		'Club',
		'Commercial Statutory Body',
		'Company',
		'Incorporated Association',
		'Industry Body',
		'Non-profit Organisation',
		'Other',
		'Partnership',
		'Pending TM Owner',
		'Political Party',
		'Registered Business',
		'Religious/Church Group',
		'Sole Trader',
		'Trade Union',
		'Trademark'
	);

	public function __construct($organisationType)
	{
		if (!in_array($organisationType, static::$organisationTypes))
		{
			throw new UnknownOrganisationTypeException("Unknown organisation type [{$organisationType}]");
		}

		$this->organisationType = $organisationType;
	}

	public function getOrganisationType()
	{
		return $this->organisationType;
	}

	public function isRegisteredBusiness()
	{
		return $this->organisationType == 'Registered Business';
	}

	public function isCompany()
	{
		return $this->organisationType == 'Company';
	}

	public function __toString()
	{
		return $this->getOrganisationType();
	}

	public function equals(AuOrganisationType $other)
	{
		return $this->organisationType === $other->organisationType;
	}
}
