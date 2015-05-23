<?php namespace SynergyWholesale\Commands;

class BalanceQueryCommandTest extends \PHPUnit_Framework_TestCase
{
	public function testGetRequestData()
	{
		$command = new BalanceQueryCommand();
		$build = $command->getRequestData();

		$this->assertTrue(is_array($build));
		$this->assertTrue(empty($build));
	}
}
