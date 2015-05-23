<?php  namespace SynergyWholesale\Types;

class DomainListTest extends \PHPUnit_Framework_TestCase
{
	public function testNoDomainArray()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'Expected an array of domain names');

		$list = array();
		new DomainList($list);
	}

	public function testBadDomainArray()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'Invalid domain name [foo]');

		$list = array('foo', 'bar');
		new DomainList($list);
	}


	public function testDomainlist()
	{
		$list = array(
			'example.com',
			new Domain('example.net')
		);

		$dl = new DomainList($list);
		$list = $dl->getDomainList();

		$this->assertTrue(is_array($list));
		$this->assertArrayHasKey(0, $list);
		$this->assertInstanceOf('SynergyWholesale\Types\Domain', $list[0]);
		$this->assertEquals('example.com', strval($list[0]));
		$this->assertArrayHasKey(1, $list);
		$this->assertInstanceOf('SynergyWholesale\Types\Domain', $list[1]);
		$this->assertEquals('example.net', strval($list[1]));

		$list = $dl->getDomainNames();

		$this->assertTrue(is_array($list));
		$this->assertArrayHasKey(0, $list);
		$this->assertTrue(is_string($list[0]));
		$this->assertEquals('example.com', strval($list[0]));
		$this->assertArrayHasKey(1, $list);
		$this->assertTrue(is_string($list[1]));
		$this->assertEquals('example.net', strval($list[1]));

		$this->assertEquals('example.com, example.net', strval($dl));
	}
}
