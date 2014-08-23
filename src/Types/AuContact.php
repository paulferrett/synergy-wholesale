<?php  namespace SynergyWholesale\Types;

class AuContact extends Contact
{
	protected $state;
	protected $postcode;

	function __construct(
		$firstname, $lastname,
		$organisation,
		$address1, $address2, $address3,
		$suburb,
		AuState $state,
		Country $country,
		AuPostCode $postcode,
		Phone $phone,
		Email $email,
		Phone $fax = null
	)
	{
		if (empty($firstname)) throw new InvalidArgumentException("firstname parameter is required");
		if (empty($lastname)) throw new InvalidArgumentException("lastname parameter is required");
		if (empty($address1)) throw new InvalidArgumentException("address1 parameter is required");
		if (empty($suburb)) throw new InvalidArgumentException("suburb parameter is required");

		$this->firstname = $firstname;
		$this->lastname = $lastname;
		$this->organisation = $organisation;
		$this->address1 = $address1;
		$this->address2 = $address2;
		$this->address3 = $address3;
		$this->suburb = $suburb;
		$this->state = $state;
		$this->country = $country;
		$this->postcode = $postcode;
		$this->phone = $phone;
		$this->email = $email;
		$this->fax = $fax;
	}

	public function getStateName()
	{
		return $this->state->getState();
	}

	public function getPostcodeString()
	{
		return $this->postcode->getPostcode();
	}
}

?>
 