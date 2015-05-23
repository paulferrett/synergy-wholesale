<?php  namespace SynergyWholesale\Responses;

use stdClass;

class BulkCheckDomainResponseTest extends \PHPUnit_Framework_TestCase
{
	public function testMissingDomainList()
	{
		$data = new stdClass();
		$data->status = "OK";

		$this->setExpectedException('SynergyWholesale\Exception\BadDataException', 'Expected property [domainList] missing from response data');

		new BulkCheckDomainResponse($data, 'BulkCheckDomainCommand');
	}

	public function testMissingArrayData()
	{
		$data = new stdClass();
		$data->status = "OK";
		$data->domainList = "";

		$this->setExpectedException('SynergyWholesale\Exception\BadDataException', 'Empty or invalid domainList found in response');

		new BulkCheckDomainResponse($data, 'BulkCheckDomainCommand');
	}

	public function testMissingArrayData2()
	{
		$data = new stdClass();
		$data->status = "OK";
		$data->domainList = array();

		$this->setExpectedException('SynergyWholesale\Exception\BadDataException', 'Empty or invalid domainList found in response');

		new BulkCheckDomainResponse($data, 'BulkCheckDomainCommand');
	}

	public function testResponse()
	{
		$d1 = new stdClass();
		$d1->domain = 'foo.com';
		$d1->available = 0;

		$d2 = new stdClass();
		$d2->domain = 'foo.com.au';
		$d2->available = 1;

		$data = new stdClass();
		$data->status = "OK";
		$data->domainList = array($d1, $d2);

		$response = new BulkCheckDomainResponse($data, 'BulkCheckDomainCommand');
		$domains = $response->getAvailableDomains();

		$this->assertTrue(is_array($domains));
		$this->assertArrayHasKey('foo.com', $domains);
		$this->assertEquals(false, $domains['foo.com']);
		$this->assertArrayHasKey('foo.com.au', $domains);
		$this->assertEquals(true, $domains['foo.com.au']);
	}
}
