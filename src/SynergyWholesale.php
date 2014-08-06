<?php namespace Hampel\SynergyWholesale;

use Hampel\SynergyWholesale\Exception\SynergyWholesaleSoapException;
use Hampel\SynergyWholesale\Exception\SynergyWholesaleResponseException;
use Hampel\SynergyWholesale\Exception\SynergyWholesaleErrorException;
use SoapFault;
use SoapClient;
use Hampel\SynergyWholesale\Commands\CommandInterface;

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

	/** @var Response response object representing the last response from SoapClient call to Synergy Wholesale API */
	protected $last_response;

	protected $last_command;

	/**
	 * Constructor
	 *
	 * @param SoapClient $client	Soap client
	 * @param string $reseller_id	Reseller id
	 * @param string $api_key		Synergy Wholesale api key
	 */
	public function __construct(SoapClient $client, $reseller_id, $api_key)
	{
		$this->client = $client;
		$this->reseller_id = $reseller_id;
		$this->api_key = $api_key;
	}

	/**
	 * Make - construct a service object
	 *
	 * @param string $reseller_id
	 * @param string $api_key
	 * @return LinodeService a fully hydrated Linode Service, ready to run
	 */
	public static function make($reseller_id, $api_key)
	{
		$config = ['location' => self::$base_url . "?wsdl", 'uri' => ''];

		$client = new SoapClient(null, $config);

		return new static($client, $reseller_id, $api_key);
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
		return $this->send($command->getCommand(), $command->build());
	}

	protected function send($command, $options)
	{
		$this->last_command = $command;
		if (!is_array($options)) $options = array();

		$data = array('resellerID' => $this->reseller_id, 'apiKey' => $this->api_key);

		try
		{
			$response = call_user_func(array($this->client, $command), $data + $options);
		}
		catch (SoapFault $e)
		{
			throw new SynergyWholesaleSoapException($e->getMessage(), $e->getCode(), $e->faultcode, $command, $e);
		}

		$this->last_response = $response;
		return $this->parseResponse($response);
	}

	protected function parseResponse($data)
	{
		if (empty($data) OR !is_object($data)) throw new SynergyWholesaleResponseException("Empty response received", $this->last_command);

		if (!isset($data->status)) throw new SynergyWholesaleResponseException("No status found in response", $this->last_command);

		if (!empty($data->errorMessage))
		{
			throw new SynergyWholesaleErrorException(
				$data->errorMessage,
				isset($data->statusCode) ? $data->statusCode : 0,
				$data->status,
				$this->last_command
			);
		}

		return $data;
	}

	/**
	 * Return the response object from the last API call made
	 *
	 * @return Response Guzzle Reponse object
	 */
	public function getLastResponse()
	{
		return $this->last_response;
	}

}

?>