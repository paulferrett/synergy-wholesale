<?php  namespace SynergyWholesale\Types;

class DomainTest extends \PHPUnit_Framework_TestCase {

	public function testBadDomain()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'Invalid domain name [example]');

		new Domain('example');
	}

	public function testDomain()
	{
		$domain = new Domain('example.com');

		$this->assertEquals('example.com', $domain->getName());
		$this->assertEquals('example.com', strval($domain));
		$this->assertEquals('com', $domain->getTld());
		$this->assertEquals('com', $domain->getExtension());
		$this->assertEquals('example', $domain->getBaseName());
		$this->assertFalse($domain->isCcTld());
		$this->assertFalse($domain->is2ld());
		$this->assertFalse($domain->isSubDomain());

		$domain = new Domain('www.example.co.nz');

		$this->assertEquals('www.example.co.nz', $domain->getName());
		$this->assertEquals('www.example.co.nz', strval($domain));
		$this->assertEquals('nz', $domain->getTld());
		$this->assertEquals('co.nz', $domain->getExtension());
		$this->assertEquals('example', $domain->getBaseName());
		$this->assertTrue($domain->isCcTld());
		$this->assertTrue($domain->is2ld());
		$this->assertTrue($domain->isSubDomain());
	}
}
