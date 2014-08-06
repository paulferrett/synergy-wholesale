<?php namespace Hampel\SynergyWholesale;

use Mockery;
use stdClass;

class SynergyWholesaleTest extends \PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->client = Mockery::mock('SoapClient');

		$this->command = Mockery::mock('Hampel\SynergyWholesale\Commands\CommandInterface');
		$this->command->shouldReceive('getCommand')->andReturn('foo');
		$this->command->shouldReceive('build')->andReturn(array());
	}

	public function testSoapException()
	{
		$this->client->shouldReceive('foo')->andThrow('SoapFault', '1');

		$this->setExpectedException('Hampel\SynergyWholesale\Exception\SynergyWholesaleSoapException');

		$sw = new SynergyWholesale($this->client, "reseller_id", "api_key");
		$sw->execute($this->command);
	}

	public function testNullResponseException()
	{
		$this->client->shouldReceive('foo')->andReturn(null);

		$this->setExpectedException('Hampel\SynergyWholesale\Exception\SynergyWholesaleResponseException', 'Empty response received');

		$sw = new SynergyWholesale($this->client, "reseller_id", "api_key");
		$sw->execute($this->command);
	}

	public function testEmptyResponseException()
	{
		$this->client->shouldReceive('foo')->andReturn("");

		$this->setExpectedException('Hampel\SynergyWholesale\Exception\SynergyWholesaleResponseException', 'Empty response received');

		$sw = new SynergyWholesale($this->client, "reseller_id", "api_key");
		$sw->execute($this->command);
	}

	public function testEmptyObjectResponseException()
	{
		$this->client->shouldReceive('foo')->andReturn(new stdClass());

		$this->setExpectedException('Hampel\SynergyWholesale\Exception\SynergyWholesaleResponseException', 'No status found in response');

		$sw = new SynergyWholesale($this->client, "reseller_id", "api_key");
		$sw->execute($this->command);
	}

	public function testBadObjectResponseException()
	{
		$testResponse = new stdClass();
		$testResponse->status = "bar";

		$this->client->shouldReceive('foo')->andReturn($testResponse);

		$this->setExpectedException('Hampel\SynergyWholesale\Exception\SynergyWholesaleResponseException', 'No status code found in response');

		$sw = new SynergyWholesale($this->client, "reseller_id", "api_key");
		$sw->execute($this->command);
	}

	public function testErrorObjectResponseException()
	{
		$testResponse = new stdClass();
		$testResponse->status = "bar";
		$testResponse->statusCode = "baz";

		$this->client->shouldReceive('foo')->andReturn($testResponse);

		$this->setExpectedException('Hampel\SynergyWholesale\Exception\SynergyWholesaleResponseException', 'No error message found in response');

		$sw = new SynergyWholesale($this->client, "reseller_id", "api_key");
		$sw->execute($this->command);
	}

	public function testOkResponseException()
	{
		$testResponse = new stdClass();
		$testResponse->status = "OK";
		$testResponse->statusCode = "bar";
		$testResponse->data = "baz";

		$this->client->shouldReceive('foo')->andReturn($testResponse);

		$sw = new SynergyWholesale($this->client, "reseller_id", "api_key");
		$response = $sw->execute($this->command);

		$this->assertTrue(isset($response->status));
		$this->assertEquals('OK', $response->status);
		$this->assertTrue(isset($response->statusCode));
		$this->assertEquals('bar', $response->statusCode);
		$this->assertTrue(isset($response->data));
		$this->assertEquals('baz', $response->data);
	}

    public function tearDown()
    {
        Mockery::close();
    }
}

?>