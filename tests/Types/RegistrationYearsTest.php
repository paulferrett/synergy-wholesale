<?php  namespace SynergyWholesale\Types;

class RegistrationYearsTest extends \PHPUnit_Framework_TestCase
{
	public function testBadYears()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'Years parameter is required and should be a positive integer value');

		new RegistrationYears(null);
	}

	public function testBadYears2()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'Years parameter is required and should be a positive integer value');

		new RegistrationYears(-1);
	}

	public function testBadYears3()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'Years parameter is required and should be a positive integer value');

		new RegistrationYears(0);
	}

	public function testBadYears4()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'Years parameter is required and should be a positive integer value');

		new RegistrationYears(1.5);
	}

	public function testBadYears5()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'Years parameter is required and should be a positive integer value');

		new RegistrationYears(11);
	}

	public function testYears()
	{
		$years = new RegistrationYears(2);

		$this->assertEquals(2, $years->getYears());
		$this->assertEquals("2", strval($years));
		$this->assertTrue($years->equals(new RegistrationYears("2")));
	}
}
