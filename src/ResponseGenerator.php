<?php  namespace SynergyWholesale;

use stdClass;

interface ResponseGenerator
{
	public function buildResponse($commandName, stdClass $response, $soapCommand);
}
