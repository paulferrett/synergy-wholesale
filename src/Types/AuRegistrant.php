<?php  namespace SynergyWholesale\Types;

use SynergyWholesale\Exception\InvalidArgumentException;

class AuRegistrant
{
	/** @var string */
	private $registrantName;

	/** @var string */
	private $registrantId;

	/** @var \SynergyWholesale\Types\AuIdType 'ABN', 'ACN', 'NSW BN', etc */
	private $registrantIdType;

	/** @var \SynergyWholesale\Types\AuOrganisationType Charity, Company, Incorporated Association, Registered Business, etc */
	private $eligibilityType;

	/** @var string entityName */
	private $eligibilityName;

	/** @var string ACN number, ABN number, BN number, etc  */
	private $eligibilityId;

	/** @var \SynergyWholesale\Types\AuIdType 'ABN', 'ACN', 'NSW BN', etc */
	private $eligibilityIdType;

	function __construct(
		$registrantName,
		$registrantId,
		AuOrganisationType $eligibilityType,
		AuIdType $registrantIdType = null,
		$eligibilityName = null,
		$eligibilityId = null,
		AuIdType $eligibilityIdType = null
	)
	{
		if (empty($registrantName))
		{
			throw new InvalidArgumentException("Missing argument: registrantName");
		}

		if (empty($registrantId) AND $eligibilityType->isCompany())
		{
			throw new InvalidArgumentException("Missing argument for Company registrant: registrantId");
		}

		$this->registrantName = $registrantName;
		$this->registrantId = $registrantId;
		$this->eligibilityType = $eligibilityType;
		$this->registrantIdType = $registrantIdType;
		$this->eligibilityName = $eligibilityName;
		$this->eligibilityId = $eligibilityId;
		$this->eligibilityIdType = $eligibilityIdType;
	}

	public static function newFromAuBusinessRegistration(AuBusinessRegistration $registration, $registrantName = "")
	{
		$eligibilityType = $registration->getOrganisationType();

		if ($eligibilityType->isRegisteredBusiness())
		{
			if (empty($registrantName))
			{
				throw new InvalidArgumentException("registrantName parameter is required for a Registered Business");
			}

			$registrantId = null;
			$registrantIdType = null;
			$eligibilityName = $registration->getEntityName();
			$eligibilityId = $registration->getRegistrationNumber();
			$eligibilityIdType = AuIdType::createFromState($registration->getState());
		}
		elseif ($eligibilityType->isCompany())
		{
			$registrantName = $registration->getEntityName();
			$registrantId = $registration->getRegistrationNumber();
			$registrantIdType = strlen($registrantId) < 11 ? AuIdType::ACN() : AuIdType::ABN();
			$eligibilityName = null;
			$eligibilityId = null;
			$eligibilityIdType = null;
		}
		else
		{
			$registrantName = $registration->getEntityName();
			$registrantId = $registration->getRegistrationNumber();
			$registrantIdType = AuIdType::newOther();
			$eligibilityName = $registration->getLegalName();
			$eligibilityId = null;
			$eligibilityIdType = null;
		}

		return new static($registrantName, $registrantId, $eligibilityType, $registrantIdType, $eligibilityName, $eligibilityId, $eligibilityIdType);
	}

	public function getRegistrantName()
	{
		return $this->registrantName;
	}

	public function getRegistrantId()
	{
		return $this->registrantId;
	}

	public function getRegistrantIdType()
	{
		return $this->registrantIdType;
	}

	public function getRegistrantIdTypeString()
	{
		if (isset($this->registrantIdType))
		{
			return strval($this->registrantIdType);
		}
	}

	public function getEligibilityType()
	{
		return $this->eligibilityType;
	}

	public function getEligibilityTypeString()
	{
		return strval($this->eligibilityType);
	}

	public function getEligibilityName()
	{
		return $this->eligibilityName;
	}

	public function getEligibilityId()
	{
		return $this->eligibilityId;
	}

	public function getEligibilityIdType()
	{
		return $this->eligibilityIdType;
	}

	public function getEligibilityIdTypeString()
	{
		if (isset($this->eligibilityIdType))
		{
			return strval($this->eligibilityIdType);
		}
	}
}
