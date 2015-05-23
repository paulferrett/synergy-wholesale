<?php  namespace SynergyWholesale\Commands;

class SendSMSCommandTest extends \PHPUnit_Framework_TestCase
{
	public function testCommand()
	{
		$command = new SendSMSCommand(
			'0400000000',
			'foo',
			'bar'
		);

		$build = $command->getRequestData();

		$this->assertTrue(is_array($build));
		$this->assertArrayHasKey('destination', $build);
		$this->assertEquals('0400000000', $build['destination']);
		$this->assertArrayHasKey('senderID', $build);
		$this->assertEquals('foo', $build['senderID']);
		$this->assertArrayHasKey('message', $build);
		$this->assertEquals('bar', $build['message']);
	}
}
