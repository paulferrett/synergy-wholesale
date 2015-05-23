<?php  namespace SynergyWholesale\Types;

class AuIdTypeTest extends \PHPUnit_Framework_TestCase
{
	public function testBadType()
	{
		$this->setExpectedException('SynergyWholesale\Exception\UnknownIdTypeException', 'Unknown id type [foo]');

		new AuIdType('foo');
	}

	public function testIdType()
	{
		$id = new AuIdType('ABN');
		$this->assertEquals('ABN', $id->getIdType());
		$this->assertEquals('ABN', strval($id));
		$this->assertTrue($id->equals(AuIdType::ABN()));

		$id = AuIdType::ACN();
		$this->assertEquals('ACN', $id->getIdType());
		$this->assertFalse($id->equals(AuIdType::ABN()));

		$id = AuIdType::OTHER();
		$this->assertEquals('OTHER', $id->getIdType());

		$state = new AuState('NSW');
		$id = AuIdType::createFromState($state);
		$this->assertEquals('NSW BN', $id->getIdType());
	}
}
