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
		$this->assertEquals('Business for profit', $ap->getAppPurposeDescription());
		$this->assertEquals('Business for profit', strval($ap));

		$ap = new UsAppPurpose('P4');
		$this->assertEquals('P4', $ap->getAppPurpose());
		$this->assertEquals('Educational', $ap->getAppPurposeDescription());
		$this->assertEquals('Educational', strval($ap));
	}
}

?>
 