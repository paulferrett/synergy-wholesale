<?php  namespace SynergyWholesale\Responses;

use stdClass;

class GetTransferredAwayDomainsResponseTest extends \PHPUnit_Framework_TestCase
{
	public function testResponse()
	{
		$data = new stdClass();
		$data->status = "OK";
		$data->domains = array(
			array(
				'domainname' => 'example.com.au',
				'registrar' => 'foo',
				'timestamp' => 'bar'
			)
		);

		$response = new GetTransferredAwayDomainsResponse($data, 'GetTransferredAwayDomainsCommand');
		$domains = $response->getDomains();

		$this->assertTrue(is_array($domains));
		$this->assertArrayHasKey(0, $domains);
		$this->assertTrue(is_array($domains[0]));
		$this->assertArrayHasKey('domainname', $domains[0]);
		$this->assertEquals('example.com.au', $domains[0]['domainname']);
		$this->assertArrayHasKey('registrar', $domains[0]);
		$this->assertEquals('foo', $domains[0]['registrar']);
		$this->assertArrayHasKey('timestamp', $domains[0]);
		$this->assertEquals('bar', $domains[0]['timestamp']);
	}
}
