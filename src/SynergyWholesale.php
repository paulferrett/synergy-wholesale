<?php namespace Hampel\SynergyWholesale;

use stdClass;
use SoapFault;
use SoapClient;
use ReflectionClass;
use Hampel\SynergyWholesale\Commands\CommandInterface;
use Hampel\SynergyWholesale\Exception\SoapException;
use Hampel\SynergyWholesale\Exception\BadDataException;
use Hampel\SynergyWholesale\Exception\ResponseErrorException;

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

	/** @var ResponseGeneratorInterface */
	protected $responseGenerator;

	/**
	 * Constructor
	 *
	 * @param SoapClient $client							soap client
	 * @param ResponseGeneratorInterface $responseGenerator	response generator
	 * @param string $reseller_id 							Synergy Wholesale reseller id
	 * @param string $api_key								Synergy Wholesale api key
	 */
	public function __construct(SoapClient $client, ResponseGeneratorInterface $responseGenerator, $reseller_id, $api_key)
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
		$responseGenerator = new ResponseGenerator();

		return new static($client, $responseGenerator, $reseller_id, $api_key);
	}

	/**
	 * Make a call to the API via Guzzle
	 *
	 * @param CommandInterface $command		Command to send
	 *
	 * @return mixed						Data returned from api call
	 */
	public function execute(CommandInterface $command)
	{
		// build our options array for the SoapRequest
		$options = $this->buildOptions($command->getRequestData());

		// find the soap command to execute
		$soapCommand = $this->getSoapCommand($command);

		// send the SoapRequest
		$response = $this->send($soapCommand, $options);

		// build a response object
		return $this->responseGenerator->buildResponse($command, $response, $soapCommand);
	}

	protected function buildOptions($options)
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

	protected function getSoapCommand(CommandInterface $command)
	{
		$class = new ReflectionClass(get_class($command));
		$shortName = $class->getShortName();
		return lcfirst(substr_replace($shortName, '', strrpos($shortName, 'Command')));
	}

	protected function send($command, $options)
	{
		try
		{
			$response = call_user_func(array($this->client, $command), $options);
		}
		catch (SoapFault $e)
		{
			throw new SoapException($e->getMessage(), $e->getCode(), $e->faultcode, $command, $e);
		}

		if (empty($response) OR !is_object($response)) throw new BadDataException("Empty response received from Soap command [{$command}]", $command);
		if (! $response instanceof stdClass) throw new BadDataException("Expected a stdClass response from Soap command [{$command}]", $command);
		if (!isset($response->status)) throw new BadDataException("No status found in response to Soap command [{$command}]", $command);

		return $response;
	}
}

?>