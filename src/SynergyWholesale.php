<?php namespace SynergyWholesale;

use stdClass;
use SoapFault;
use SoapClient;
use ReflectionClass;
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

	/**
	 * Constructor
	 *
	 * @param SoapClient $client							soap client
	 * @param ResponseGenerator $responseGenerator	response generator
	 * @param string $reseller_id 							Synergy Wholesale reseller id
	 * @param string $api_key								Synergy Wholesale api key
	 */
	public function __construct(SoapClient $client, ResponseGenerator $responseGenerator, $reseller_id, $api_key)
	{
		$this->client = $client;
		$this->responseGenerator = $responseGenerator;
		$this->reseller_id = $reseller_id;
		$this->api_key = $api_key;
	}

	/**
	 * Make - construct a default service object
	 *
	 * If you need something other than the default - construct your own using the constructor rather than via this
	 * factory.
	 *
	 * @param string $reseller_id
	 * @param string $api_key
	 * @return LinodeService a fully hydrated Linode Service, ready to run
	 */
	public static function make($reseller_id, $api_key)
	{
		$config = ['location' => self::$base_url . "?wsdl", 'uri' => ''];

		$client = new SoapClient(null, $config);
		$responseGenerator = new BasicResponseGenerator();

		return new static($client, $responseGenerator, $reseller_id, $api_key);
	}

	/**
	 * Make a call to the API via Guzzle
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
			$response = call_user_func(array($this->client, $soapCommand), $options);
		}
		catch (SoapFault $e)
		{
			throw new SoapException($e->getMessage(), $e->getCode(), $e->faultcode, $soapCommand, $e);
		}

		if (empty($response) OR !is_object($response)) throw new BadDataException("Empty response received from Soap command [{$soapCommand}]", $soapCommand);
		if (! $response instanceof stdClass) throw new BadDataException("Expected a stdClass response from Soap command [{$soapCommand}]", $soapCommand);

		return $response;
	}
}

?>