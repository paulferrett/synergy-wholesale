<?php  namespace SynergyWholesale\Types; 

class AuContactTest extends \PHPUnit_Framework_TestCase
{
	public function testBadContact1()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'firstname parameter is required');
		$contact = new Contact('', '', '', '', '', '', '', '', new Country('AU'), '', new Phone('+61.111111111'), new Email('foo@example.com'));
	}

	public function testBadContact2()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'lastname parameter is required');
		$contact = new Contact('firstname', '', '', '', '', '', '', '', new Country('AU'), '', new Phone('+61.111111111'), new Email('foo@example.com'));
	}

	public function testBadContact3()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'address1 parameter is required');
		$contact = new Contact('firstname', 'lastname', '', '', '', '', '', '', new Country('AU'), '', new Phone('+61.111111111'), new Email('foo@example.com'));
	}

	public function testBadContact4()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'suburb parameter is required');
		$contact = new Contact('firstname', 'lastname', '', 'address1', '', '', '', '', new Country('AU'), '', new Phone('+61.111111111'), new Email('foo@example.com'));
	}

	public function testBadContact5()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'state parameter is required');
		$contact = new Contact('firstname', 'lastname', '', 'address1', '', '', 'suburb', '', new Country('AU'), '', new Phone('+61.111111111'), new Email('foo@example.com'));
	}

	public function testBadContact6()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'postcode parameter is required');
		$contact = new Contact('firstname', 'lastname', '', 'address1', '', '', 'suburb', 'state', new Country('AU'), '', new Phone('+61.111111111'), new Email('foo@example.com'));
	}

	public function testContact()
	{
		$contact = new AuContact(
			'firstname',
			'lastname',
			'organisation',
			'address1',
			'address2',
			'address3',
			'suburb',
			new AuState('NSW'),
			new Country('AU'),
			new AuPostCode('1111'),
			new Phone('+61.111111111'),
			new Email('foo@example.com'),
			new Phone('+61.222222222')
		);
		$this->assertEquals('firstname', $contact->getFirstname());
		$this->assertEquals('lastname', $contact->getLastname());
		$this->assertEquals('organisation', $contact->getOrganisation());
		$this->assertEquals('address1', $contact->getAddress1());
		$this->assertEquals('address2', $contact->getAddress2());
		$this->assertEquals('address3', $contact->getAddress3());
		$this->assertEquals('suburb', $contact->getSuburb());
		$this->assertInstanceOf('SynergyWholesale\Types\AuState', $contact->getState());
		$this->assertEquals('NSW', $contact->getStateName());
		$this->assertInstanceOf('SynergyWholesale\Types\Country', $contact->getCountry());
		$this->assertEquals('AU', $contact->getCountry()->getCountryCode());
		$this->assertInstanceOf('SynergyWholesale\Types\AuPostcode', $contact->getPostcode());
		$this->assertEquals('1111', $contact->getPostcodeString());
		$this->assertInstanceOf('SynergyWholesale\Types\Phone', $contact->getPhone());
		$this->assertEquals('+61.111111111', $contact->getPhone()->getPhone());
		$this->assertInstanceOf('SynergyWholesale\Types\Email', $contact->getEmail());
		$this->assertEquals('foo@example.com', $contact->getEmail()->getEmail());
		$this->assertInstanceOf('SynergyWholesale\Types\Phone', $contact->getFax());
		$this->assertEquals('+61.222222222', $contact->getFax()->getPhone());
	}
}

?>
 