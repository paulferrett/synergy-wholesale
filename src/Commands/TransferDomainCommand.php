<?php  namespace SynergyWholesale\Commands;

use Hampel\Validate\Validator;
use SynergyWholesale\Types\Bool;
use SynergyWholesale\Types\Domain;
use SynergyWholesale\Types\Contact;
use SynergyWholesale\Exception\InvalidArgumentException;

class TransferDomainCommand implements Command
{
	/** @var \SynergyWholesale\Types\Domain */
	protected $domainName;

	/** @var string */
	protected $authInfo;

	/** @var \SynergyWholesale\Types\Contact */
	protected $contact;

	/** @var \SynergyWholesale\Types\Bool */
	protected $idProtect;

	/** @var \SynergyWholesale\Types\Bool */
	protected $doRenewal;

	function __construct(
		Domain $domainName,
		$authInfo,
		Contact $contact,
		Bool $idProtect = null,
		Bool $doRenewal = null
	)
	{
		if (empty($authInfo) OR !is_string($authInfo))
		{
			throw new InvalidArgumentException("authInfo parameter is required");
		}

		$this->domainName = $domainName;
		$this->authInfo = $authInfo;
		$this->contact = $contact;
		$this->idProtect = $idProtect;
		$this->doRenewal = $doRenewal;
	}

	public function getRequestData()
	{
		return array(
			'domainName' => $this->domainName->getName(),
			'authInfo' => $this->authInfo,

			'firstname' => $this->contact->getFirstname(),
			'lastname' => $this->contact->getLastname(),
			'organisation' => $this->contact->getOrganisation(),
			'address' => array(
				$this->contact->getAddress1(),
				$this->contact->getAddress2(),
				$this->contact->getAddress3()
			),
			'suburb' => $this->contact->getSuburb(),
			'state' => $this->contact->getState(),
			'country' => $this->contact->getCountryCode(),
			'postcode' => $this->contact->getPostcode(),
			'phone' => $this->contact->getPhoneNumber(),
			'fax' => $this->contact->getFaxNumber(),
			'email' => $this->contact->getEmailAddress(),

			'idProtect' => $this->idProtect->isTrue() ? 'Y' : '',
			'doRenewal' => $this->doRenewal->isFalse() ? '0' : ''
		);
	}
}

?>
 