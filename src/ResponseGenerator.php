<?php  namespace Hampel\SynergyWholesale;

use stdClass;
use ReflectionClass;
use Hampel\SynergyWholesale\Commands\CommandInterface;
use Hampel\SynergyWholesale\Exception\ClassNotRegisteredException;

class ResponseGenerator implements ResponseGeneratorInterface
{
	public function buildResponse(CommandInterface $command, stdClass $response, $soapCommand)
	{
		$handler = $this->getResponseClass($command);
		return new $handler($response, $soapCommand);
	}

	/**
	 * Converts command class names to response names
	 *
	 * Hampel\SynergyWholesale\Commands\FooCommand => Hampel\SynergyWholesale\Responses\FooResponse
	 *
	 * @param CommandInterface $command
	 *
	 * @return string Response class name
	 * @throws Exception\ClassNotRegisteredException
	 */
	protected function getResponseClass(CommandInterface $command)
	{
		$class = new ReflectionClass(get_class($command));
		$shortName = $class->getShortName();
		$namespace = $class->getNamespaceName();

		$responseShortName = substr_replace($shortName, 'Response', strrpos($shortName, 'Command'));
		$responseNamespace = substr_replace($namespace, 'Responses', strrpos($namespace, 'Commands'));

		$responseClass = "{$responseNamespace}\\{$responseShortName}";

		if ( ! class_exists($responseClass))
		{
			$message = "Response class [$responseClass] does not exist";
			throw new ClassNotRegisteredException($message);
		}

		return $responseClass;
	}
}

?>
 