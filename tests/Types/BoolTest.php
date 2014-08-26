<?php  namespace SynergyWholesale\Types; 

class BoolTest extends \PHPUnit_Framework_TestCase
{
	public function testBool()
	{
		$this->assertTrue((new Bool('y'))->getBool());
		$this->assertTrue((new Bool('Y'))->getBool());
		$this->assertTrue((new Bool('yes'))->getBool());
		$this->assertTrue((new Bool('Yes'))->getBool());
		$this->assertTrue((new Bool('YES'))->getBool());
		$this->assertTrue((new Bool('on'))->getBool());
		$this->assertTrue((new Bool('On'))->getBool());
		$this->assertTrue((new Bool('ON'))->getBool());
		$this->assertTrue((new Bool('t'))->getBool());
		$this->assertTrue((new Bool('T'))->getBool());
		$this->assertTrue((new Bool('true'))->getBool());
		$this->assertTrue((new Bool('True'))->getBool());
		$this->assertTrue((new Bool('TRUE'))->getBool());
		$this->assertTrue((new Bool('enabled'))->getBool());
		$this->assertTrue((new Bool('Enabled'))->getBool());
		$this->assertTrue((new Bool('ENABLED'))->getBool());
		$this->assertTrue((new Bool('1'))->getBool());

		$this->assertFalse((new Bool('n'))->getBool());
		$this->assertFalse((new Bool('n'))->getBool());
		$this->assertFalse((new Bool('no'))->getBool());
		$this->assertFalse((new Bool('No'))->getBool());
		$this->assertFalse((new Bool('NO'))->getBool());
		$this->assertFalse((new Bool('off'))->getBool());
		$this->assertFalse((new Bool('Off'))->getBool());
		$this->assertFalse((new Bool('OFF'))->getBool());
		$this->assertFalse((new Bool('f'))->getBool());
		$this->assertFalse((new Bool('F'))->getBool());
		$this->assertFalse((new Bool('false'))->getBool());
		$this->assertFalse((new Bool('False'))->getBool());
		$this->assertFalse((new Bool('FALSE'))->getBool());
		$this->assertFalse((new Bool('disabled'))->getBool());
		$this->assertFalse((new Bool('Disabled'))->getBool());
		$this->assertFalse((new Bool('DISABLED'))->getBool());
		$this->assertFalse((new Bool('0'))->getBool());

		$this->assertTrue(Bool::true()->getBool());
		$this->assertFalse(Bool::false()->getBool());

		$this->assertTrue(Bool::true()->isTrue());
		$this->assertTrue(Bool::false()->isFalse());

		$this->assertEquals('true', strval(Bool::true()));
		$this->assertEquals('false', strval(Bool::false()));
	}
}

?>
 