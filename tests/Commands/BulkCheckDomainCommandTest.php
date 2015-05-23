<?php namespace SynergyWholesale\Commands;

use SynergyWholesale\Types\Domain;
use SynergyWholesale\Types\DomainList;

class BulkCheckDomainCommandTest extends \PHPUnit_Framework_TestCase
{
	public function testGetRequestData()
	{
		$list = new DomainList(array(
			'example.com',
			new Domain('example.net')
		));

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
