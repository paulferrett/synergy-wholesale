<?php  namespace SynergyWholesale\Responses;

use SynergyWholesale\Types\Email;
use SynergyWholesale\Types\Phone;
use SynergyWholesale\Types\Contact;
use SynergyWholesale\Types\Country;
use SynergyWholesale\Exception\BadDataException;

class ListContactsResponse extends Response
{
	/** @var Contact */
	protected $registrant;

	/** @var Contact */
	protected $tech;

	/** @var Contact */
	protected $admin;

	/** @var Contact */
	protected $billing;

	protected $expectedFields = array(
		'registrant', 'tech'
	);

	protected $expectedContactFields = array(
		'firstname', 'lastname', 'address1', 'suburb', 'state', 'country', 'postcode', 'phone', 'email'
	);

	protected $contactTypes = array(
		'registrant', 'tech', 'admin', 'billing'
	);

	protected function validateData()
	{
		//var_dump($this->response->registrant);

		foreach ($this->contactTypes as $type)
		{
			if (!isset($this->response->{$type})) continue; // skip contact types that aren't present in data

			foreach ($this->expectedContactFields as $field)
			{
				if (!isset($this->response->{$type}->{$field}))
				{
					$message = "Expected property [{$type}->{$field}] missing from response data";
					throw new BadDataException($message, $this->command, $this->response);
				}
			}
		}

		$this->registrant = new Contact(
			$this->response->registrant->firstname,
			$this->response->registrant->lastname,
			isset($this->response->registrant->company) ? $this->response->registrant->company : "",
			$this->response->registrant->address1,
			isset($this->response->registrant->address2) ? $this->response->registrant->address2 : "",
			isset($this->response->registrant->address3) ? $this->response->registrant->address3 : "",
			$this->response->registrant->suburb,
			$this->response->registrant->state,
			new Country($this->response->registrant->country),
			$this->response->registrant->postcode,
			new Phone($this->response->registrant->phone),
			new Email($this->response->registrant->email),
			isset($this->response->registrant->fax) ? new Phone($this->response->registrant->fax) : null
		);

		$this->tech = new Contact(
			$this->response->tech->firstname,
			$this->response->tech->lastname,
			isset($this->response->tech->company) ? $this->response->tech->company : "",
			$this->response->tech->address1,
			isset($this->response->tech->address2) ? $this->response->tech->address2 : "",
			isset($this->response->tech->address3) ? $this->response->tech->address3 : "",
			$this->response->tech->suburb,
			$this->response->tech->state,
			new Country($this->response->tech->country),
			$this->response->tech->postcode,
			new Phone($this->response->tech->phone),
			new Email($this->response->tech->email),
			isset($this->response->tech->fax) ? new Phone($this->response->tech->fax) : null
		);

		if (isset($this->response->admin))
		{
			$this->admin = new Contact(
				$this->response->admin->firstname,
				$this->response->admin->lastname,
				isset($this->response->admin->company) ? $this->response->admin->company : "",
				$this->response->admin->address1,
				isset($this->response->admin->address2) ? $this->response->admin->address2 : "",
				isset($this->response->admin->address3) ? $this->response->admin->address3 : "",
				$this->response->admin->suburb,
				$this->response->admin->state,
				new Country($this->response->admin->country),
				$this->response->admin->postcode,
				new Phone($this->response->admin->phone),
				new Email($this->response->admin->email),
				isset($this->response->admin->fax) ? new Phone($this->response->admin->fax) : null
			);
		}

		if (isset($this->response->billing))
		{
			$this->billing = new Contact(
				$this->response->billing->firstname,
				$this->response->billing->lastname,
				isset($this->response->billing->company) ? $this->response->billing->company : "",
				$this->response->billing->address1,
				isset($this->response->billing->address2) ? $this->response->billing->address2 : "",
				isset($this->response->billing->address3) ? $this->response->billing->address3 : "",
				$this->response->billing->suburb,
				$this->response->billing->state,
				isset($this->response->billing->country) ? new Country($this->response->billing->country) : null,
				$this->response->billing->postcode,
				new Phone($this->response->billing->phone),
				new Email($this->response->billing->email),
				isset($this->response->billing->fax) ? new Phone($this->response->billing->fax) : null
			);
		}
	}

	public function getRegistrant()
	{
		return $this->registrant;
	}

	public function getTech()
	{
		return $this->tech;
	}

	public function getAdmin()
	{
		return $this->admin;
	}

	public function getBilling()
	{
		return $this->billing;
	}
}
