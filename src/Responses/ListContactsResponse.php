<?php  namespace SynergyWholesale\Responses;

use SynergyWholesale\Types\Email;
use SynergyWholesale\Types\Phone;
use SynergyWholesale\Types\Contact;
use SynergyWholesale\Types\Country;

class ListContactsResponse extends Response
{
	protected $expectedFields = array(
		'registrant', 'tech'
	);

	public function getRegistrant()
	{
		return new Contact(
			$this->response->registrant['firstname'],
			$this->response->registrant['lastname'],
			$this->response->registrant['company'],
			$this->response->registrant['address1'],
			$this->response->registrant['address2'],
			$this->response->registrant['address3'],
			$this->response->registrant['suburb'],
			$this->response->registrant['state'],
			new Country($this->response->registrant['country']),
			$this->response->registrant['postcode'],
			new Phone($this->response->registrant['phone']),
			new Email($this->response->registrant['email']),
			$this->response->registrant['fax'] ? new Phone($this->response->registrant['fax']) : null
		);
	}
	
	public function getTech()
	{
		return new Contact(
			$this->response->tech['firstname'],
			$this->response->tech['lastname'],
			$this->response->tech['company'],
			$this->response->tech['address1'],
			$this->response->tech['address2'],
			$this->response->tech['address3'],
			$this->response->tech['suburb'],
			$this->response->tech['state'],
			new Country($this->response->tech['country']),
			$this->response->tech['postcode'],
			new Phone($this->response->tech['phone']),
			new Email($this->response->tech['email']),
			$this->response->tech['fax'] ? new Phone($this->response->tech['fax']) : null
		);
	}	
	
	public function getAdmin()
	{
		if (!isset($this->response->admin)) return null;

		return new Contact(
			$this->response->admin['firstname'],
			$this->response->admin['lastname'],
			$this->response->admin['company'],
			$this->response->admin['address1'],
			$this->response->admin['address2'],
			$this->response->admin['address3'],
			$this->response->admin['suburb'],
			$this->response->admin['state'],
			new Country($this->response->admin['country']),
			$this->response->admin['postcode'],
			new Phone($this->response->admin['phone']),
			new Email($this->response->admin['email']),
			$this->response->admin['fax'] ? new Phone($this->response->admin['fax']) : null
		);
	}

	public function getBilling()
	{
		if (!isset($this->response->billing)) return null;

		return new Contact(
			$this->response->billing['firstname'],
			$this->response->billing['lastname'],
			$this->response->billing['company'],
			$this->response->billing['address1'],
			$this->response->billing['address2'],
			$this->response->billing['address3'],
			$this->response->billing['suburb'],
			$this->response->billing['state'],
			new Country($this->response->billing['country']),
			$this->response->billing['postcode'],
			new Phone($this->response->billing['phone']),
			new Email($this->response->billing['email']),
			$this->response->billing['fax'] ? new Phone($this->response->billing['fax']) : null
		);
	}
}

?>
 