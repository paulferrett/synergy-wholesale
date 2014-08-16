<?php namespace Hampel\SynergyWholesale;

use Mockery;
use stdClass;

class SynergyWholesaleTest extends \PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->client = Mockery::mock('SoapClient');

		$this->command = Mockery::namedMock('FooCommand', 'Hampel\SynergyWholesale\Commands\CommandInterface');
		$this->command->shouldReceive('getRequestData')->andReturn(array());

		$this->responseGenerator = Mockery::mock('Hampel\SynergyWholesale\ResponseGeneratorInterface');

		$this->response = Mockery::mock('Hampel\SynergyWholesale\Responses\Response');
	}

	public function testSoapException()
	{
		$this->client->shouldReceive('foo')->andThrow('SoapFault', '1');

		$this->setExpectedException('Hampel\SynergyWholesale\Exception\SoapException');

		$sw = new SynergyWholesale($this->client, $this->responseGenerator, "reseller_id", "api_key");
		$sw->execute($this->command);
	}

	public function testNullResponseException()
	{
		$this->client->shouldReceive('foo')->andReturn(null);

		$this->setExpectedException('Hampel\SynergyWholesale\Exception\BadDataException', 'Empty response received');

		$sw = new SynergyWholesale($this->client, $this->responseGenerator, "reseller_id", "api_key");
		$sw->execute($this->command);
	}

	public function testEmptyResponseException()
	{
		$this->client->shouldReceive('foo')->andReturn("");

		$this->setExpectedException('Hampel\SynergyWholesale\Exception\BadDataException', 'Empty response received');

		$sw = new SynergyWholesale($this->client, $this->responseGenerator, "reseller_id", "api_key");
		$sw->execute($this->command);
	}

	public function testEmptyObjectResponseException()
	{
		$this->client->shouldReceive('foo')->andReturn(new stdClass());

		$this->setExpectedException('Hampel\SynergyWholesale\Exception\BadDataException', 'No status found in response');

		$sw = new SynergyWholesale($this->client, $this->responseGenerator, "reseller_id", "api_key");
		$sw->execute($this->command);
	}

	public function testWrongObjectResponseException()
	{
		$otherobject = Mockery::mock();

		$this->client->shouldReceive('foo')->andReturn($otherobject);

		$this->setExpectedException('Hampel\SynergyWholesale\Exception\BadDataException', 'Expected a stdClass response from Soap command [foo]');

		$sw = new SynergyWholesale($this->client, $this->responseGenerator, "reseller_id", "api_key");
		$sw->execute($this->command);
	}

	public function testBadObjectResponseException()
	{
		$testResponse = new stdClass();
		$testResponse->bar = "baz";

		$this->client->shouldReceive('foo')->andReturn($testResponse);

		$this->setExpectedException('Hampel\SynergyWholesale\Exception\BadDataException', 'No status found in response to Soap command [foo]');

		$sw = new SynergyWholesale($this->client, $this->responseGenerator, "reseller_id", "api_key");
		$sw->execute($this->command);
	}

	public function testExecute()
	{
		$testResponse = new stdClass();
		$testResponse->status = "OK";

		$this->client->shouldReceive('foo')->andReturn($testResponse);
		$this->responseGenerator->shouldReceive('buildResponse')->with($this->command, $testResponse, 'foo')->andReturn($this->response);

		$sw = new SynergyWholesale($this->client, $this->responseGenerator, "reseller_id", "api_key");
		$response = $sw->execute($this->command);

		$this->assertInstanceOf('Hampel\SynergyWholesale\Responses\Response', $response);
	}

    public function tearDown()
    {
        Mockery::close();
    }
}

?>