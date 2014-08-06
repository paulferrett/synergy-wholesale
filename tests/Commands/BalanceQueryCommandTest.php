<?php namespace Hampel\SynergyWholesale\Commands;


class BalanceQueryCommandTest extends \PHPUnit_Framework_TestCase
{

	public function testBuild()
	{
		$command = new BalanceQueryCommand();
		$build = $command->build();

		$this->assertTrue(is_array($build));
		$this->assertTrue(empty($build));
	}
}

?>