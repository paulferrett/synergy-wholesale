<?php  namespace SynergyWholesale\Types;

class PhoneTest extends \PHPUnit_Framework_TestCase {

	public function testBadPhone1()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'Invalid phone number [] - must be in the format +99.999999999');

		$phone = new Phone('');
	}

	public function testBadPhone2()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'Invalid phone number [+0.0] - must be in the format +99.999999999');

		$phone = new Phone('+0.0');
	}

	public function testBadPhone3()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'Invalid phone number [+AA.AAAAAAAAA] - must be in the format +99.999999999');

		$phone = new Phone('+AA.AAAAAAAAA');
	}

	public function testPhone()
	{
		$phone = new Phone('+00.000000000');
		$this->assertEquals('+00.000000000', $phone->getPhone());

		$phone = new Phone('+0.000000');
		$this->assertEquals('+00.000000000', $phone->getPhone());

		// test space stripping
		$phone = new Phone('+00.0 0000 0000');
		$this->assertEquals('+00.000000000', $phone->getPhone());
	}
}

?>
 