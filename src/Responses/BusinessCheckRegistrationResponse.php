<?php  namespace SynergyWholesale\Responses;

use SynergyWholesale\Exception\InvalidArgumentException;
use SynergyWholesale\Types\AuBusinessRegistration;
use SynergyWholesale\Types\AuOrganisationType;
use SynergyWholesale\Types\AuPostCode;
use SynergyWholesale\Types\AuState;

class BusinessCheckRegistrationResponse extends Response
{
	protected $expectedFields = array(
		'entityStatus', 'entityName',
	);

	public function getRegistrationNumber()
	{
		if (isset($this->response->registrationNumber))
		{
			return $this->response->registrationNumber;
		}
	}

	public function getEntityStatus()
	{
		return $this->response->entityStatus;
	}

	public function getAsicNumber()
	{
		if (isset($this->response->asicNumber))
		{
			return $this->response->asicNumber;
		}
	}

	public function getEntityName()
	{
		return $this->response->entityName;
	}

	public function getTradingName()
	{
		if (isset($this->response->tradingName))
		{
			return $this->response->tradingName;
		}
	}

	public function getLegalName()
	{
		if (isset($this->response->legalName))
		{
			return $this->response->legalName;
		}
	}

	public function getOrganisationType()
	{
		if (isset($this->response->organisationType))
		{
			return $this->response->organisationType;
		}
	}

	public function getState()
	{
		if (isset($this->response->state))
		{
			return $this->response->state;
		}
		elseif (isset($this->response->registrationState))
		{
			return $this->response->registrationState;
		}
	}

	public function getPostcode()
	{
		if (isset($this->response->postcode))
		{
			return $this->response->postcode;
		}
	}

	public function getAuBusinessRegistration($registrationNumber, $state = null)
	{
		$entityStatus = $this->getEntityStatus();
		$organisationType = $this->getOrganisationType();

		$state = $this->getState() ?: $state;
		if (isset($state))
		{
			$state = new AuState($state);
		}

		if ($entityStatus == 'Registered' AND isset($state) AND !isset($organisationType))
		{
			$organisationType = 'Registered Business';
		}

		$postcode = $this->getPostcode();
		if (isset($postcode))
		{
			$postcode = new AuPostCode($postcode);
		}

		$organisationType = new AuOrganisationType($organisationType);

		$registrationNumber = $this->getRegistrationNumber() ?: $registrationNumber;
		$registrationNumber = str_replace(' ', '', $registrationNumber);

		$asicNumber = $this->getAsicNumber() ? str_replace(' ', '', $this->getAsicNumber()) : $this->getAsicNumber();

		$entityName = $this->getEntityName();
		$tradingName = $this->getTradingName();
		$legalName = $this->getLegalName();

		return new AuBusinessRegistration(
			$registrationNumber,
			$entityStatus,
			$asicNumber,
			$entityName,
			$tradingName,
			$legalName,
			$organisationType,
			$state,
			$postcode
		);
	}
}
