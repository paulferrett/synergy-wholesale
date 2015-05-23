<?php  namespace SynergyWholesale\Commands;

class GetTransferredAwayDomainsCommandTest extends \PHPUnit_Framework_TestCase
{
	public function testGetRequestData()
	{
		$command = new GetTransferredAwayDomainsCommand();
		$build = $command->getRequestData();

		$this->assertTrue(is_array($build));
		$this->assertTrue(empty($build));
	}
}
