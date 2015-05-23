<?php  namespace SynergyWholesale\Types;

class UsAppPurposeTest extends \PHPUnit_Framework_TestCase
{
	public function testBadAppPurpose()
	{
		$this->setExpectedException('SynergyWholesale\Exception\UnknownAppPurposeException', 'Unknown app purpose [foo]');

		new UsAppPurpose('foo');
	}

	public function testUsAppPurpose()
	{
		$ap = new UsAppPurpose('P1');
		$this->assertEquals('P1', $ap->getAppPurpose());
		$this->assertEquals('P1', strval($ap));
		$this->assertEquals(UsAppPurpose::BUSINESS_FOR_PROFIT, strval($ap));
		$this->assertTrue($ap->equals(UsAppPurpose::BUSINESS()));
	}
}
