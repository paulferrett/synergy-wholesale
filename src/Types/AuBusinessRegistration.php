<?php  namespace SynergyWholesale\Types; 

class AuBusinessRegistration
{
	private $registrationNumber;
	private $entityStatus;
	private $asicNumber;
	private $entityName;
	private $tradingName;
	private $legalName;
	private $organisationType;
	private $state;
	private $postcode;

	function __construct(
		$registrationNumber,
		$entityStatus,
		$asicNumber,
		$entityName,
		$tradingName,
		$legalName,
		AuOrganisationType $organisationType,
		AuState $state = null,
		AuPostCode $postcode = null
	)
	{
		$this->registrationNumber = $registrationNumber;
		$this->entityStatus = $entityStatus;
		$this->asicNumber = $asicNumber;
		$this->entityName = $entityName;
		$this->tradingName = $tradingName;
		$this->legalName = $legalName;
		$this->organisationType = $organisationType;
		$this->state = $state;
		$this->postcode = $postcode;
	}

	public function getRegistrationNumber()
	{
		return $this->registrationNumber;
	}

	public function getEntityStatus()
	{
		return $this->entityStatus;
	}

	public function getAsicNumber()
	{
		return $this->asicNumber;
	}

	public function getEntityName()
	{
		return $this->entityName;
	}

	public function getTradingName()
	{
		return $this->tradingName;
	}

	public function getLegalName()
	{
		return $this->legalName;
	}

	public function getOrganisationType()
	{
		return $this->organisationType;
	}

	public function getOrganisationTypeName()
	{
		return $this->organisationType->getOrganisationType();
	}

	public function getState()
	{
		return $this->state;
	}

	public function getStateName()
	{
		if (isset($this->state))
		{
			return $this->state->getState();
		}
	}

	public function getPostcode()
	{
		return $this->postcode;
	}

	public function getPostcodeString()
	{
		if (isset($this->postcode))
		{
			return $this->postcode->getPostcode();
		}
	}
}
