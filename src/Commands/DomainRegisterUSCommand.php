<?php  namespace SynergyWholesale\Commands;

use SynergyWholesale\Types\Contact;
use SynergyWholesale\Types\UsDomain;
use SynergyWholesale\Types\DomainList;
use SynergyWholesale\Types\UsAppPurpose;
use SynergyWholesale\Types\UsNexusCategory;
use SynergyWholesale\Types\RegistrationYears;

class DomainRegisterUSCommand implements Command
{
	/** @var \SynergyWholesale\Types\UsDomain */
	protected $domainName;

	/** @var \SynergyWholesale\Types\RegistrationYears */
	protected $years;

	/** @var \SynergyWholesale\Types\DomainList */
	protected $nameServers;

	/** @var \SynergyWholesale\Types\Contact */
	protected $contact;

	/** @var \SynergyWholesale\Types\UsAppPurpose */
	protected $appPurpose;

	/** @var \SynergyWholesale\Types\UsNexusCategory */
	protected $nexusCategory;

	function __construct(
		UsDomain $domainName,
		RegistrationYears $years,
		DomainList $nameServers,
		Contact $contact,
		UsAppPurpose $appPurpose,
		UsNexusCategory $nexusCategory
	)
	{
		$this->domainName = $domainName;
		$this->years = $years;
		$this->nameServers = $nameServers;
		$this->contact = $contact;
		$this->appPurpose = $appPurpose;
		$this->nexusCategory = $nexusCategory;
	}

	public function getRequestData()
	{
		return array(
			'domainName' => $this->domainName->getName(),
			'years' => $this->years->getYears(),
			'nameServers' => $this->nameServers->getDomainNames(),

			'contact_firstname' => $this->contact->getFirstname(),
			'contact_lastname' => $this->contact->getLastname(),
			'contact_organisation' => $this->contact->getOrganisation(),
			'contact_address' => array(
				$this->contact->getAddress1(),
				$this->contact->getAddress2(),
				$this->contact->getAddress3()
			),
			'contact_suburb' => $this->contact->getSuburb(),
			'contact_state' => $this->contact->getState(),
			'contact_country' => $this->contact->getCountryCode(),
			'contact_postcode' => $this->contact->getPostcode(),
			'contact_phone' => $this->contact->getPhoneNumber(),
			'contact_fax' => $this->contact->getFaxNumber(),
			'contact_email' => $this->contact->getEmailAddress(),

			'appPurpose' => $this->appPurpose->getAppPurpose(),
			'nexusCategory' => $this->nexusCategory->getNexusCategory()
		);
	}
}
