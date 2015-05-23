<?php  namespace SynergyWholesale\Types; 

class EmailTest extends \PHPUnit_Framework_TestCase {

	public function testBadEmail1()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'Invalid email address []');

		$phone = new Email('');
	}

	public function testBadEmail2()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'Invalid email address [foo@example]');

		$phone = new Email('foo@example');
	}

	public function testEmail()
	{
		$email = new Email('foo@example.com');
		$this->assertEquals('foo@example.com', $email->getEmail());
	}
}
