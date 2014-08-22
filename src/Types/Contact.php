<?php  namespace SynergyWholesale\Types; 

use Mockery\CountValidator\Exception;
use SynergyWholesale\Exception\InvalidArgumentException;

class Contact
{
	protected $firstname;
	protected $lastname;
	protected $organisation;
	protected $address1;
	protected $address2;
	protected $address3;
	protected $suburb;
	protected $state;
	protected $country;
	protected $postcode;
	protected $phone;
	protected $email;
	protected $fax;

	function __construct(
		$firstname, $lastname,
		$organisation,
		$address1, $address2, $address3,
		$suburb, $state,
		Country $country,
		$postcode,
		Phone $phone,
		Email $email,
		Phone $fax = null
	)
	{
		if (empty($firstname)) throw new InvalidArgumentException("firstname parameter is required");
		if (empty($lastname)) throw new InvalidArgumentException("lastname parameter is required");
		if (empty($address1)) throw new InvalidArgumentException("address1 parameter is required");
		if (empty($suburb)) throw new InvalidArgumentException("suburb parameter is required");
		if (empty($state)) throw new InvalidArgumentException("state parameter is required");
		if (empty($postcode)) throw new InvalidArgumentException("postcode parameter is required");

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

	public function getFirstname()
	{
		return $this->firstname;
	}

	public function getLastname()
	{
		return $this->lastname;
	}

	public function getOrganisation()
	{
		return $this->organisation;
	}

	public function getAddress1()
	{
		return $this->address1;
	}

	public function getAddress2()
	{
		return $this->address2;
	}

	public function getAddress3()
	{
		return $this->address3;
	}

	public function getSuburb()
	{
		return $this->suburb;
	}

	public function getState()
	{
		return $this->state;
	}

	public function getCountry()
	{
		return $this->country;
	}

	public function getCountryName()
	{
		return $this->country->getCountryName();
	}

	public function getPostcode()
	{
		return $this->postcode;
	}

	public function getPhone()
	{
		return $this->phone;
	}

	public function getPhoneNumber()
	{
		return $this->phone->getPhone();
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getEmailAddress()
	{
		return $this->email->getEmail();
	}

	public function getFax()
	{
		return $this->fax;
	}

	public function getFaxNumber()
	{
		if (isset($this->fax)){
			return $this->fax->getPhone();
		}
	}
}

?>
