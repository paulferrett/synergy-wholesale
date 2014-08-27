<?php  namespace SynergyWholesale\Responses;

use stdClass;

class EnableIdProtectionResponseTest extends \PHPUnit_Framework_TestCase
{
	public function testResponse()
	{
		$data = new stdClass;
		$data->status = "OK";

		$response = new EnableIdProtectionResponse($data, 'EnableIdProtectionCommand');

		$this->assertTrue($response->enableSuccessful());
	}
}

?>
 