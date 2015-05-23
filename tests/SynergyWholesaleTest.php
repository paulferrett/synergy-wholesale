<?php namespace SynergyWholesale;

use Mockery;
use stdClass;

class SynergyWholesaleTest extends \PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->client = Mockery::mock('SoapClient');

		$this->command = Mockery::namedMock('FooCommand', 'SynergyWholesale\Commands\Command');
		$this->command->shouldReceive('getRequestData')->andReturn(array());

		$this->responseGenerator = Mockery::mock('SynergyWholesale\ResponseGenerator');

		$this->response = Mockery::mock('SynergyWholesale\Responses\Response');
	}

	public function testSoapException()
	{
		$this->client->shouldReceive('foo')->andThrow('SoapFault', '1');

		$this->setExpectedException('SynergyWholesale\Exception\SoapException');

		$sw = new SynergyWholesale($this->client, $this->responseGenerator, null, "reseller_id", "api_key");
		$sw->execute($this->command);
	}

	public function testNullResponseException()
	{
		$this->client->shouldReceive('foo')->andReturn(null);

		$this->setExpectedException('SynergyWholesale\Exception\BadDataException', 'Empty response received');

		$sw = new SynergyWholesale($this->client, $this->responseGenerator, null, "reseller_id", "api_key");
		$sw->execute($this->command);
	}

	public function testEmptyResponseException()
	{
		$this->client->shouldReceive('foo')->andReturn("");

		$this->setExpectedException('SynergyWholesale\Exception\BadDataException', 'Empty response received');

		$sw = new SynergyWholesale($this->client, $this->responseGenerator, null, "reseller_id", "api_key");
		$sw->execute($this->command);
	}

	public function testWrongObjectResponseException()
	{
		$otherobject = Mockery::mock();

		$this->client->shouldReceive('foo')->andReturn($otherobject);

		$this->setExpectedException('SynergyWholesale\Exception\BadDataException', 'Expected a stdClass response from Soap command [foo]');

		$sw = new SynergyWholesale($this->client, $this->responseGenerator, null, "reseller_id", "api_key");
		$sw->execute($this->command);
	}

	public function testExecute()
	{
		$testResponse = new stdClass();
		$testResponse->status = "OK";

		$this->client->shouldReceive('foo')->andReturn($testResponse);
		$this->responseGenerator->shouldReceive('buildResponse')->with('FooCommand', $testResponse, 'foo')->andReturn($this->response);

		$sw = new SynergyWholesale($this->client, $this->responseGenerator, null, "reseller_id", "api_key");
		$response = $sw->execute($this->command);

		$this->assertInstanceOf('SynergyWholesale\Responses\Response', $response);
	}

    public function tearDown()
    {
        Mockery::close();
    }
}

