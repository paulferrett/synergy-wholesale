<?php  namespace Hampel\SynergyWholesale; 

use stdClass;
use Hampel\SynergyWholesale\Commands\CommandInterface;

interface ResponseGeneratorInterface
{
	public function buildResponse(CommandInterface $command, stdClass $response, $soapCommand);
}

?>
 