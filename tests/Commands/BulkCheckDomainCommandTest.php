<?php namespace SynergyWholesale\Commands;

use SynergyWholesale\Types\Domain;

class BulkCheckDomainCommandTest extends \PHPUnit_Framework_TestCase
{
	public function testNoDomainArray()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'Empty domain list passed to BulkCheckDomainCommand');

		$list = array();
		$command = new BulkCheckDomainCommand($list);
	}

	public function testBadDomainArray()
	{
		$this->setExpectedException('SynergyWholesale\Exception\InvalidArgumentException', 'BulkCheckDomainCommand expects an array of SynergyWholesale\Types\Domain objects');

		$list = array('foo', 'bar');
		$command = new BulkCheckDomainCommand($list);
	}

	public function testGetRequestData()
	{
		$list = array(
			new Domain('example.com'),
			new Domain('example.net')
		);

		$command = new BulkCheckDomainCommand($list);
		$build = $command->getRequestData();

		$this->assertTrue(is_array($build));
		$this->assertArrayHasKey('domainList', $build);
		$this->assertTrue(is_array($build['domainList']));
		$this->assertArrayHasKey(0, $build['domainList']);
		$this->assertEquals('example.com', $build['domainList'][0]);
		$this->assertArrayHasKey(1, $build['domainList']);
		$this->assertEquals('example.net', $build['domainList'][1]);
	}
}

?>