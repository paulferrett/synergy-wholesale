<?php  namespace SynergyWholesale;

use stdClass;
use ReflectionClass;
use SynergyWholesale\Exception\ClassNotRegisteredException;

class BasicResponseGenerator implements ResponseGenerator
{
	public function buildResponse($commandName, stdClass $response, $soapCommand)
	{
		$handler = $this->getResponseClass($commandName);
		return new $handler($response, $soapCommand);
	}

	/**
	 * Converts command class names to response names
	 *
	 * SynergyWholesale\Commands\FooCommand => SynergyWholesale\Responses\FooResponse
	 *
	 * @param string $commandName
	 *
	 * @return string Response class name
	 * @throws Exception\ClassNotRegisteredException
	 */
	protected function getResponseClass($commandName)
	{
		$class = new ReflectionClass($commandName);
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
