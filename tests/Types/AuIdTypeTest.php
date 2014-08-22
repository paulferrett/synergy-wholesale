<?php  namespace SynergyWholesale\Types;

class AuIdTypeTest extends \PHPUnit_Framework_TestCase
{
	public function testBadType()
	{
		$this->setExpectedException('SynergyWholesale\Exception\UnknownIdTypeException', 'Unknown id type [foo]');

		$idtype = new AuIdType('foo');
	}

	public function testIdType()
	{
		$id = new AuIdType('ABN');
		$this->assertEquals('ABN', $id->getIdType());
		$this->assertEquals('ABN', strval($id));

		$id = AuIdType::newAcn();
		$this->assertEquals('ACN', $id->getIdType());

		$state = new AuState('NSW');
		$id = AuIdType::newFromState($state);
		$this->assertEquals('NSW BN', $id->getIdType());
	}
}

?>
 