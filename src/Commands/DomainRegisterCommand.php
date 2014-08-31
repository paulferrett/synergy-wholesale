<?php  namespace SynergyWholesale\Commands; 

use Hampel\Validate\Validator;
use SynergyWholesale\Types\Bool;
use SynergyWholesale\Types\Domain;
use SynergyWholesale\Types\Contact;
use SynergyWholesale\Types\DomainList;
use SynergyWholesale\Types\RegistrationYears;

class DomainRegisterCommand implements Command
{
	/** @var \SynergyWholesale\Types\Domain */
	protected $domainName;

	/** @var \SynergyWholesale\Types\RegistrationYears */
	protected $years;

	/** @var \SynergyWholesale\Types\DomainList */
	protected $nameServers;

	/** @var \SynergyWholesale\Types\Bool */
	protected $idProtect;

	/** @var \SynergyWholesale\Types\Contact */
	protected $registrant_contact;

	/** @var \SynergyWholesale\Types\Contact */
	protected $billing_contact;

	/** @var \SynergyWholesale\Types\Contact */
	protected $admin_contact;

	/** @var \SynergyWholesale\Types\Contact */
	protected $technical_contact;

	function __construct(
		Domain $domainName,
		RegistrationYears $years,
		DomainList $nameServers,
		Bool $idProtect,
		Contact $registrant_contact,
		Contact $billing_contact,
		Contact $admin_contact,
		Contact $technical_contact
	)
	{
		$this->domainName = $domainName;
		$this->years = $years;
		$this->nameServers = $nameServers;
		$this->idProtect = $idProtect;
		$this->registrant_contact = $registrant_contact;
		$this->billing_contact = $billing_contact;
		$this->admin_contact = $admin_contact;
		$this->technical_contact = $technical_contact;
	}

	public function getRequestData()
	{
		return array(
			'domainName' => $this->domainName->getName(),
			'years' => $this->years->getYears(),
			'nameServers' => $this->nameServers->getDomainNames(),
			'idProtect' => $this->idProtect->isTrue() ? 'Y' : '',

			'registrant_firstname' => $this->registrant_contact->getFirstname(),
			'registrant_lastname' => $this->registrant_contact->getLastname(),
			'registrant_organisation' => $this->registrant_contact->getOrganisation(),
			'registrant_address' => array(
				$this->registrant_contact->getAddress1(),
				$this->registrant_contact->getAddress2(),
				$this->registrant_contact->getAddress3()
			),
			'registrant_suburb' => $this->registrant_contact->getSuburb(),
			'registrant_state' => $this->registrant_contact->getState(),
			'registrant_country' => $this->registrant_contact->getCountryCode(),
			'registrant_postcode' => $this->registrant_contact->getPostcode(),
			'registrant_phone' => $this->registrant_contact->getPhoneNumber(),
			'registrant_fax' => $this->registrant_contact->getFaxNumber(),
			'registrant_email' => $this->registrant_contact->getEmailAddress(),

			'billing_firstname' => $this->billing_contact->getFirstname(),
			'billing_lastname' => $this->billing_contact->getLastname(),
			'billing_organisation' => $this->billing_contact->getOrganisation(),
			'billing_address' => array(
				$this->billing_contact->getAddress1(),
				$this->billing_contact->getAddress2(),
				$this->billing_contact->getAddress3()
			),
			'billing_suburb' => $this->billing_contact->getSuburb(),
			'billing_state' => $this->billing_contact->getState(),
			'billing_country' => $this->billing_contact->getCountryCode(),
			'billing_postcode' => $this->billing_contact->getPostcode(),
			'billing_phone' => $this->billing_contact->getPhoneNumber(),
			'billing_fax' => $this->billing_contact->getFaxNumber(),
			'billing_email' => $this->billing_contact->getEmailAddress(),

			'admin_firstname' => $this->admin_contact->getFirstname(),
			'admin_lastname' => $this->admin_contact->getLastname(),
			'admin_organisation' => $this->admin_contact->getOrganisation(),
			'admin_address' => array(
				$this->admin_contact->getAddress1(),
				$this->admin_contact->getAddress2(),
				$this->admin_contact->getAddress3()
			),
			'admin_suburb' => $this->admin_contact->getSuburb(),
			'admin_state' => $this->admin_contact->getState(),
			'admin_country' => $this->admin_contact->getCountryCode(),
			'admin_postcode' => $this->admin_contact->getPostcode(),
			'admin_phone' => $this->admin_contact->getPhoneNumber(),
			'admin_fax' => $this->admin_contact->getFaxNumber(),
			'admin_email' => $this->admin_contact->getEmailAddress(),

			'technical_firstname' => $this->technical_contact->getFirstname(),
			'technical_lastname' => $this->technical_contact->getLastname(),
			'technical_organisation' => $this->technical_contact->getOrganisation(),
			'technical_address' => array(
				$this->technical_contact->getAddress1(),
				$this->technical_contact->getAddress2(),
				$this->technical_contact->getAddress3()
			),
			'technical_suburb' => $this->technical_contact->getSuburb(),
			'technical_state' => $this->technical_contact->getState(),
			'technical_country' => $this->technical_contact->getCountryCode(),
			'technical_postcode' => $this->technical_contact->getPostcode(),
			'technical_phone' => $this->technical_contact->getPhoneNumber(),
			'technical_fax' => $this->technical_contact->getFaxNumber(),
			'technical_email' => $this->technical_contact->getEmailAddress(),
		);
	}
}

?>
 