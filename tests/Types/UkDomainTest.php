<?php  namespace SynergyWholesale\Types;

class UkDomainTest extends \PHPUnit_Framework_TestCase
{
	public function testBadDomain()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'Invalid domain name [example.com] - must be a .uk domain');

		new UkDomain('example.com');
	}

	public function testDomain()
	{
		$domain = new UkDomain('example.uk');

		$this->assertEquals('example.uk', $domain->getName());
		$this->assertEquals('example.uk', strval($domain));
		$this->assertEquals('uk', $domain->getTld());
		$this->assertEquals('uk', $domain->getExtension());
		$this->assertEquals('example', $domain->getBaseName());
		$this->assertTrue($domain->isCcTld());
		$this->assertFalse($domain->is2ld());
		$this->assertFalse($domain->isSubDomain());

		$domain = new UkDomain('www.example.co.uk');

		$this->assertEquals('www.example.co.uk', $domain->getName());
		$this->assertEquals('www.example.co.uk', strval($domain));
		$this->assertEquals('uk', $domain->getTld());
		$this->assertEquals('co.uk', $domain->getExtension());
		$this->assertEquals('example', $domain->getBaseName());
		$this->assertTrue($domain->isCcTld());
		$this->assertTrue($domain->is2ld());
		$this->assertTrue($domain->isSubDomain());
	}
}
