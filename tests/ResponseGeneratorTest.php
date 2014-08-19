<?php
namespace SynergyWholesale
{
	use stdClass;

	class ResponseGeneratorTest extends \PHPUnit_Framework_TestCase
	{
		public function testSoapException()
		{
			$commandName = 'SynergyWholesale\Commands\FooCommand';

			$this->setExpectedException('SynergyWholesale\Exception\ClassNotRegisteredException', 'Response class [SynergyWholesale\Responses\FooResponse] does not exist');

			$rg = new BasicResponseGenerator();
			$rg->buildResponse($commandName, new StdClass(), 'foo');
		}

		public function testGenerator()
		{
			$commandName = 'SynergyWholesale\Commands\BarCommand';

			$rg = new BasicResponseGenerator();
			$response = $rg->buildResponse($commandName, new StdClass(), 'bar');

			$this->assertInstanceOf('SynergyWholesale\Responses\BarResponse', $response);
		}
	}
}

namespace SynergyWholesale\Commands
{
	class FooCommand
	{

	}

	class BarCommand
	{

	}
}

namespace SynergyWholesale\Responses
{
	class BarResponse
	{

	}
}
