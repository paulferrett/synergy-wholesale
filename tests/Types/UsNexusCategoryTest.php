<?php  namespace SynergyWholesale\Types; 

class UsNexusCategoryTest extends \PHPUnit_Framework_TestCase
{
	public function testBadNexusCategory()
	{
		$this->setExpectedException('SynergyWholesale\Exception\UnknownNexusCategoryException', 'Unknown nexus category [foo]');

		new UsNexusCategory('foo');
	}

	public function testNexusCategory()
	{
		$nc = new UsNexusCategory('C11');
		$this->assertEquals('C11', $nc->getNexusCategory());
		$this->assertEquals('C11', strval($nc));
		$this->assertEquals(UsNexusCategory::US_CITIZEN, strval($nc));
		$this->assertTrue($nc->equals(UsNexusCategory::US_CITIZEN()));
	}
}
