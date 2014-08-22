<?php namespace SynergyWholesale;

use stdClass;
use SoapFault;
use SoapClient;
use ReflectionClass;
use Psr\Log\LoggerInterface;
use SynergyWholesale\Commands\Command;
use SynergyWholesale\Exception\SoapException;
use SynergyWholesale\Exception\BadDataException;

class SynergyWholesale
{
	/** @var string base url for API calls */
	protected static $base_url = 'https://api.synergywholesale.com';

	/** @var string reseller id provided by Synergy Wholesale */
	protected $reseller_id;

	/** @var string api key for this reseller id */
	protected $api_key;

	/** @var SoapClient our Soap Client object */
	protected $client;

	/** @var ResponseGenerator */
	protected $responseGenerator;

	/** @var LoggerInterface */
	protected $logger;

	/**
	 * Constructor
	 *
	 * @param SoapClient $client					soap client
	 * @param ResponseGenerator $responseGenerator	response generator
	 * @param LoggerInterface $logger				PSR Log interface
	 * @param string $reseller_id 					Synergy Wholesale reseller id
	 * @param string $api_key						Synergy Wholesale api key
	 */
	public function __construct(
		SoapClient $client,
		ResponseGenerator $responseGenerator,
		LoggerInterface $logger = null,
		$reseller_id,
		$api_key
	)
	{
		$this->client = $client;
		$this->responseGenerator = $responseGenerator;
		$this->logger = $logger;
		$this->reseller_id = $reseller_id;
		$this->api_key = $api_key;
	}

	/**
	 * Make - construct a default service object
	 *
	 * If you need something other than the default - construct your own using the constructor rather than via this
	 * factory. Note that this does not provide a logger - you'll need to construct your own to pass a logger
	 * implementation for logging API calls.
	 *
	 * @param string $reseller_id
	 * @param string $api_key
	 *
*@return LinodeService a fully hydrated Linode Service, ready to run
	 */
	public static function make($reseller_id, $api_key)
	{
		$config = array('location' => self::$base_url . "?wsdl", 'uri' => '');

		$client = new SoapClient(null, $config);
		$responseGenerator = new BasicResponseGenerator();

		return new static($client, $responseGenerator, null, $reseller_id, $api_key);
	}

	/**
	 * Make a call to the API via SOAP
	 *
	 * @param Command $command		Command to send
	 *
	 * @return mixed						Data returned from api call
	 */
	public function execute(Command $command)
	{
		// build our options array for the SoapRequest
		$options = $this->prepareOptions($command->getRequestData());

		// get the class name for the command - will be used to derive the soapCommand and the response handler
		$commandName = $this->getClassName($command);

		// find the soap command to execute
		$soapCommand = $this->deriveSoapCommand($commandName);

		// send the SoapRequest
		$response = $this->sendSoapCommand($soapCommand, $options);

		// build a response object
		return $this->responseGenerator->buildResponse($commandName, $response, $soapCommand);
	}

	protected function prepareOptions($options)
	{
		if (!is_array($options)) $options = array();

		return $this->getAuthData() + $options;
	}

	protected function getAuthData()
	{
		return array(
			'resellerID' => $this->reseller_id,
			'apiKey' => $this->api_key
		);
	}

	protected function getClassName($object)
	{
		return get_class($object);
	}

	protected function deriveSoapCommand($commandName)
	{
		$shortName = $this->getShortName($commandName);
		return lcfirst(substr_replace($shortName, '', strrpos($shortName, 'Command')));
	}

	protected function getShortName($className)
	{
		$class = new ReflectionClass($className);
		return $class->getShortName();
	}

	protected function sendSoapCommand($soapCommand, array $options)
	{
		try
		{
			$this->logCommand($soapCommand, $options);

			$response = call_user_func(array($this->client, $soapCommand), $options);
		}
		catch (SoapFault $e)
		{
			$this->logSoapFault($e, $soapCommand);

			throw new SoapException($e->getMessage(), $e->getCode(), $e->faultcode, $soapCommand, $e);
		}

		$this->validateResponse($response, $soapCommand);

		$this->logResponse($response, $soapCommand);

		return $response;
	}

	protected function validateResponse($response, $soapCommand)
	{
		if (empty($response) OR !is_object($response))
		{
			$message = "Empty response received from Soap command [{$soapCommand}]";

			$this->log('error', $message);
			throw new BadDataException($message, $soapCommand);
		}

		if (! $response instanceof stdClass)
		{
			$message = "Expected a stdClass response from Soap command [{$soapCommand}]";

			$this->log('error', $message);
			throw new BadDataException($message, $soapCommand);
		}
	}

	protected function logCommand($soapCommand, array $options)
	{
		if (array_key_exists('resellerID', $options)) $options['resellerID'] = '*****';
		if (array_key_exists('apiKey', $options)) $options['apiKey'] = '*****';

		$this->log('info', "Calling SOAP Command {$soapCommand}");

		$this->log('debug', "{$soapCommand} data", $options);
	}

	protected function logSoapFault(SoapFault $e, $soapCommand)
	{
		$message = "{$soapCommand} returned error [{$e->getCode()}][{$e->faultcode}]: {$e->getMessage()}";

		$this->log('error', $message, array('exception' => $e));
	}

	protected function logResponse(stdClass $response, $soapCommand)
	{
		$this->log('debug', "{$soapCommand} response", $this->objectToArray($response));
	}

	protected function log($level, $message, array $context = array())
	{
		if (!is_null($this->logger))
		{
			$this->logger->log($level, $message, $context);
		}
	}

	/**
	 * From http://www.if-not-true-then-false.com/2009/php-tip-convert-stdclass-object-to-multidimensional-array-and-convert-multidimensional-array-to-stdclass-object/
	 *
	 * @param $object
	 *
	 * @return array
	 */
	protected function objectToArray($object) {
		if (is_object($object)) {
			// Gets the properties of the given object
			// with get_object_vars function
			$object = get_object_vars($object);
		}

		if (is_array($object)) {
			/*
			* Return array converted to object
			* Using __FUNCTION__ (Magic constant)
			* for recursive call
			*/
			return array_map(array($this, __FUNCTION__), $object);
		}
		else {
			// Return array
			return $object;
		}
	}
}

?>