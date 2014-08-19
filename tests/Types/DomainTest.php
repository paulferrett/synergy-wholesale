<?php  namespace SynergyWholesale\Types;

class DomainTest extends \PHPUnit_Framework_TestCase {

	public function testBadDomain()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'Invalid domain name [example]');

		$domain = new Domain('example');
	}

	public function testDomain()
	{
		$domain = new Domain('example.com');

		$this->assertEquals('example.com', $domain->getName());
		$this->assertEquals('com', $domain->getTld());
		$this->assertEquals('example', $domain->getBaseName());
	}
}

?>
 