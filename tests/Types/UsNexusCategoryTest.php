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
		$this->assertEquals('US Citizen', $nc->getNexusCategoryDescription());
		$this->assertEquals('US Citizen', strval($nc));

		$nc = new UsNexusCategory('C31');
		$this->assertEquals('C31', $nc->getNexusCategory());
		$this->assertEquals('Foreign organisation doing business in US', $nc->getNexusCategoryDescription());
		$this->assertEquals('Foreign organisation doing business in US', strval($nc));
	}
}

?>
 