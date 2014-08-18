<?php  namespace SynergyWholesale;

use stdClass;

interface ResponseGeneratorInterface
{
	public function buildResponse($commandName, stdClass $response, $soapCommand);
}

?>
 