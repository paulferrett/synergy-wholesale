<?php  namespace SynergyWholesale\Commands;

use SynergyWholesale\Types\AuState;

class BusinessCheckRegistrationCommandTest extends \PHPUnit_Framework_TestCase
{
	public function testNoState()
	{
		$command = new BusinessCheckRegistrationCommand('foo');
		$build = $command->getRequestData();

		$this->assertTrue(is_array($build));
		$this->assertArrayHasKey('registrationNumber', $build);
		$this->assertEquals('foo', $build['registrationNumber']);
		$this->assertArrayNotHasKey('registrationState', $build);
	}

	public function testState()
	{
		$command = new BusinessCheckRegistrationCommand('foo', new AuState('NSW'));
		$build = $command->getRequestData();

		$this->assertTrue(is_array($build));
		$this->assertArrayHasKey('registrationNumber', $build);
		$this->assertEquals('foo', $build['registrationNumber']);
		$this->assertArrayHasKey('registrationState', $build);
		$this->assertEquals('NSW', $build['registrationState']);
	}
}
