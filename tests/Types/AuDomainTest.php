<?php  namespace SynergyWholesale\Types;

class AuDomainTest extends \PHPUnit_Framework_TestCase {

	public function testBadDomain()
	{
		$this->setExpectedException('SynergyWholesale\Exception\UnknownAuDomainException', 'Invalid domain name [example.com] - must be a .au domain');

		$domain = new AuDomain('example.com');
	}

	public function testDomain()
	{
		$domain = new AuDomain('example.com.au');

		$this->assertEquals('example.com.au', $domain->getName());
		$this->assertEquals('.com.au', $domain->getTld());
		$this->assertEquals('example', $domain->getBaseName());
		$this->assertTrue($domain->isCcTld());

		$domain = new AuDomain('example.net.au');

		$this->assertEquals('example.net.au', $domain->getName());
		$this->assertEquals('.net.au', $domain->getTld());
		$this->assertEquals('example', $domain->getBaseName());
		$this->assertTrue($domain->isCcTld());
	}
}

?>
 