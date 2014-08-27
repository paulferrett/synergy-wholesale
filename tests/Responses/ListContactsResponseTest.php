<?php  namespace SynergyWholesale\Responses;

use stdClass;

class ListContactsResponseTest extends \PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->contact = array(
			'firstname' => 'firstname',
			'lastname' => 'lastname',
			'company' => 'company',
			'address1' => 'address1',
			'address2' => 'address2',
			'address3' => 'address3',
			'suburb' => 'suburb',
			'state' => 'state',
			'country' => 'AU',
			'postcode' => 'postcode',
			'phone' => '+61.111111111',
			'fax' => '',
			'email' => 'foo@example.com'
		);
	}

	public function testResponse()
	{
		$data = new stdClass();
		$data->status = "OK";
		$data->registrant = $this->contact;
		$data->tech = $this->contact;

		$response = new ListContactsResponse($data, 'ListContactsCommand');

		$registrant = $response->getRegistrant();
		$this->assertInstanceOf('SynergyWholesale\Types\Contact', $registrant);
		$this->assertEquals('firstname', $registrant->getFirstname());
		$this->assertEquals('lastname', $registrant->getLastname());
		$this->assertEquals('company', $registrant->getOrganisation());
		$this->assertEquals('address1', $registrant->getAddress1());
		$this->assertEquals('address2', $registrant->getAddress2());
		$this->assertEquals('address3', $registrant->getAddress3());
		$this->assertEquals('suburb', $registrant->getSuburb());
		$this->assertEquals('state', $registrant->getState());
		$this->assertEquals('AU', $registrant->getCountry()->getCountryCode());
		$this->assertEquals('postcode', $registrant->getPostcode());
		$this->assertEquals('+61.111111111', $registrant->getPhone());
		$this->assertNull($registrant->getFax());
		$this->assertEquals('foo@example.com', $registrant->getEmail());

		$tech = $response->getTech();
		$this->assertInstanceOf('SynergyWholesale\Types\Contact', $tech);
		$this->assertEquals('firstname', $tech->getFirstname());
		$this->assertEquals('lastname', $tech->getLastname());
		$this->assertEquals('company', $tech->getOrganisation());
		$this->assertEquals('address1', $tech->getAddress1());
		$this->assertEquals('address2', $tech->getAddress2());
		$this->assertEquals('address3', $tech->getAddress3());
		$this->assertEquals('suburb', $tech->getSuburb());
		$this->assertEquals('state', $tech->getState());
		$this->assertEquals('AU', $tech->getCountry()->getCountryCode());
		$this->assertEquals('postcode', $tech->getPostcode());
		$this->assertEquals('+61.111111111', $tech->getPhone());
		$this->assertNull($tech->getFax());
		$this->assertEquals('foo@example.com', $tech->getEmail());

		$this->assertNull($response->getBilling());
		$this->assertNull($response->getAdmin());
	}
}

?>
 