<?php  namespace SynergyWholesale\Types;

class AuStateTest extends \PHPUnit_Framework_TestCase
{
	public function testBadState()
	{
		$this->setExpectedException('SynergyWholesale\Exception\UnknownStateException', 'Unknown state [FOO]');

		$state = new AuState('foo');
	}

	public function testState()
	{
		$state = new AuState('NSW');
		$this->assertEquals('NSW', $state->getState());
		$this->assertEquals('NSW', strval($state));

		$state = new AuState('vic');
		$this->assertEquals('VIC', $state->getState());
	}
}
