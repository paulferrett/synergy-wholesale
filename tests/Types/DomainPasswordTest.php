<?php  namespace SynergyWholesale\Types;

class DomainPasswordTest extends \PHPUnit_Framework_TestCase
{
	public function testShortPassword()
	{
		$this->setExpectedException('SynergyWholesale\Exception\LengthException', 'Domain passwords should contain between 6 and 16 characters');

		$password = new DomainPassword('');
	}

	public function testLongPassword()
	{
		$this->setExpectedException('SynergyWholesale\Exception\LengthException', 'Domain passwords should contain between 6 and 16 characters');

		$password = new DomainPassword('012345678901234567');
	}

	public function testPassword()
	{
		$password = new DomainPassword('foobar');

		$this->assertEquals('foobar', $password->getPassword());
	}
}
