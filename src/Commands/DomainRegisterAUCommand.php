<?php namespace SynergyWholesale\Commands;

use SynergyWholesale\Types\AuDomain;
use SynergyWholesale\Types\AuContact;
use SynergyWholesale\Types\DomainList;
use SynergyWholesale\Types\AuRegistrant;
use SynergyWholesale\Types\RegistrationYears;

class DomainRegisterAUCommand implements Command
{
	/** @var \SynergyWholesale\Types\AuDomain */
	protected $domainName;

	/** @var \SynergyWholesale\Types\RegistrationYears */
	protected $years;

	/** @var \SynergyWholesale\Types\DomainList */
	protected $nameServers;

	/** @var \SynergyWholesale\Types\AuContact */
	protected $registrant_contact;

	/** @var \SynergyWholesale\Types\AuContact */
	protected $technical_contact;

	/** @var \SynergyWholesale\Types\AuRegistrant */
	protected $registrant;

	function __construct(
		AuDomain $domainName,
		RegistrationYears $years,
		DomainList $nameServers,
		AuContact $registrant_contact,
		AuContact $technical_contact,
		AuRegistrant $registrant
	)
	{
		$this->domainName = $domainName;
		$this->years = $years;
		$this->nameServers = $nameServers;
		$this->registrant_contact = $registrant_contact;
		$this->technical_contact = $technical_contact;
		$this->registrant = $registrant;
	}

	public function getRequestData()
	{
		return array(
			'domainName' => $this->domainName->getName(),
			'years' => $this->years->getYears(),
			'nameServers' => $this->nameServers->getDomainNames(),

			'registrant_firstname' => $this->registrant_contact->getFirstname(),
			'registrant_lastname' => $this->registrant_contact->getLastname(),
			'registrant_organisation' => $this->registrant_contact->getOrganisation(),
			'registrant_address' => array(
				$this->registrant_contact->getAddress1(),
				$this->registrant_contact->getAddress2(),
				$this->registrant_contact->getAddress3()
			),
			'registrant_suburb' => $this->registrant_contact->getSuburb(),
			'registrant_state' => $this->registrant_contact->getStateName(),
			'registrant_country' => $this->registrant_contact->getCountryCode(),
			'registrant_postcode' => $this->registrant_contact->getPostcodeString(),
			'registrant_phone' => $this->registrant_contact->getPhoneNumber(),
			'registrant_fax' => $this->registrant_contact->getFaxNumber(),
			'registrant_email' => $this->registrant_contact->getEmailAddress(),

			'technical_firstname' => $this->technical_contact->getFirstname(),
			'technical_lastname' => $this->technical_contact->getLastname(),
			'technical_organisation' => $this->technical_contact->getOrganisation(),
			'technical_address' => array(
				$this->technical_contact->getAddress1(),
				$this->technical_contact->getAddress2(),
				$this->technical_contact->getAddress3()
			),
			'technical_suburb' => $this->technical_contact->getSuburb(),
			'technical_state' => $this->technical_contact->getStateName(),
			'technical_country' => $this->technical_contact->getCountryCode(),
			'technical_postcode' => $this->technical_contact->getPostcodeString(),
			'technical_phone' => $this->technical_contact->getPhoneNumber(),
			'technical_fax' => $this->technical_contact->getFaxNumber(),
			'technical_email' => $this->technical_contact->getEmailAddress(),

			'registrantName' => $this->registrant->getRegistrantName(),
			'registrantID' => $this->registrant->getRegistrantId(),
			'registrantIDType' => $this->registrant->getRegistrantIdTypeString(),
			'eligibilityType' => $this->registrant->getEligibilityTypeString(),
			'eligibilityName' => $this->registrant->getEligibilityName(),
			'eligibilityID' => $this->registrant->getEligibilityId(),
			'eligibilityIDType' => $this->registrant->getEligibilityIdTypeString()
		);
	}
}
