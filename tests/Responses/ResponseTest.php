<?php  namespace SynergyWholesale\Responses;

use Mockery;
use stdClass;

class ResponseTest extends \PHPUnit_Framework_TestCase {

	public function testEmptyObjectException()
	{
		$data = new stdClass();

		$this->setExpectedException('SynergyWholesale\Exception\BadDataException', 'No status found in response to Soap command [foo]');

		new FooBarResponse($data, 'foo');
	}

	public function testDataException()
	{
		$data = new stdClass();
		$data->status = "OK";
		$data->foo = "bar";

		$this->setExpectedException('SynergyWholesale\Exception\BadDataException', 'Expected property [bar] missing from response data');

		new FooBarResponse($data, 'foo');
	}

	public function testErrorException()
	{
		$data = new stdClass();
		$data->status = "NOT_OK";
		$data->errorMessage = "FooBar";

		$this->setExpectedException('SynergyWholesale\Exception\ResponseErrorException', 'FooBar');

		new FooBarResponse($data, 'foo');
	}

	public function testResponse()
	{
		$data = new stdClass();
		$data->status = "OK";
		$data->foo = "bar";
		$data->bar = "foo";

		$response = new FooBarResponse($data, 'foo');

		$this->assertInstanceOf('SynergyWholesale\Responses\FooBarResponse', $response);
		$this->assertTrue(isset($response->response));
		$this->assertInstanceOf('stdClass', $response->response);
		$this->assertTrue(isset($response->response->status));
		$this->assertEquals('OK', $response->response->status);
		$this->assertTrue(isset($response->response->foo));
		$this->assertEquals('bar', $response->response->foo);
	}

	public function tearDown()
	{
		Mockery::close();
	}
}

class FooBarResponse extends Response
{
	protected $expectedFields = array('foo', 'bar');

	public function validateData(){}
}

?>
 