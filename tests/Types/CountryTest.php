<?php  namespace SynergyWholesale\Types; 

class CountryTest extends \PHPUnit_Framework_TestCase {

	public function testBadCountry1()
	{
		$this->setExpectedException('SynergyWholesale\Exception\UnknownCountryException', 'Unknown country []');

		$country = new Country('');
	}

	public function testBadCountry2()
	{
		$this->setExpectedException('SynergyWholesale\Exception\UnknownCountryException', 'Unknown country [AA]');

		$country = new Country('AA');
	}

	public function testBadCountry3()
	{
		$this->setExpectedException('SynergyWholesale\Exception\UnknownCountryException', 'Unknown country [AUS]');

		$country = new Country('AUS');
	}

	public function testCountry()
	{
		$country = new Country('au');
		$this->assertEquals('AU', $country->getCountryCode());

		$country = new Country('AU');
		$this->assertEquals('AU', $country->getCountryCode());
		$this->assertEquals('Australia', $country->getCountryName());
	}
}
