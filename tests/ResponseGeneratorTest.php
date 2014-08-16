<?php
namespace Hampel\SynergyWholesale
{

	use Mockery;
	use stdClass;

	class ResponseGeneratorTest extends \PHPUnit_Framework_TestCase
	{
		public function testSoapException()
		{
			$command = Mockery::namedMock('Hampel\SynergyWholesale\Commands\FooCommand', 'Hampel\SynergyWholesale\Commands\CommandInterface');

			$this->setExpectedException('Hampel\SynergyWholesale\Exception\ClassNotRegisteredException', 'Response class [Hampel\SynergyWholesale\Responses\FooResponse] does not exist');

			$rg = new ResponseGenerator();
			$rg->buildResponse($command, new StdClass(), 'foo');
		}

		public function testGenerator()
		{
			$command = Mockery::namedMock('Hampel\SynergyWholesale\Commands\BarCommand', 'Hampel\SynergyWholesale\Commands\CommandInterface');

			$rg = new ResponseGenerator();
			$response = $rg->buildResponse($command, new StdClass(), 'bar');

			$this->assertInstanceOf('Hampel\SynergyWholesale\Responses\BarResponse', $response);
		}

		public function tearDown()
		{
			Mockery::close();
		}
	}
}

namespace Hampel\SynergyWholesale\Responses
{
	class BarResponse
	{

	}
}
