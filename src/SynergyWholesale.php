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
	/** URL for the Soap WSDL file */
	const WSDL_URL = 'https://api.synergywholesale.com/?wsdl';

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
	 * @return SynergyWholesale a fully hydrated SynergyWholesale Service, ready to run
	 */
	public static function make($reseller_id, $api_key)
	{
		$config = array('location' => self::WSDL_URL, 'uri' => '');

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

	/**
	 * @param Commands\BalanceQueryCommand $command
	 * @return Responses\BalanceQueryResponse
	 */
	public function balanceQuery(Commands\BalanceQueryCommand $command) { return $this->execute($command); }

	/**
	 * @param Commands\BulkCheckDomainCommand $command
	 * @return Responses\BulkCheckDomainResponse
	 */
	public function bulkCheckDomain(Commands\BulkCheckDomainCommand $command) { return $this->execute($command); }

	/**
	 * @param Commands\BusinessCheckRegistrationCommand $command
	 * @return Responses\BusinessCheckRegistrationResponse
	 */
	public function businessCheckRegistration(Commands\BusinessCheckRegistrationCommand $command) { return $this->execute($command); }

	/**
	 * @param Commands\CanRenewDomainCommand $command
	 * @return Responses\CanRenewDomainResponse
	 */
	public function canRenewDomain(Commands\CanRenewDomainCommand $command) { return $this->execute($command); }

	/**
	 * @param Commands\CheckDomainCommand $command
	 * @return Responses\CheckDomainResponse
	 */
	public function checkDomain(Commands\CheckDomainCommand $command) { return $this->execute($command); }

	/**
	 * @param Commands\DetermineSMSCostCommand $command
	 * @return Responses\DetermineSMSCostResponse
	 */
	public function determineSMSCost(Commands\DetermineSMSCostCommand $command) { return $this->execute($command); }

	/**
	 * @param Commands\DisableAutoRenewalCommand $command
	 * @return Responses\DisableAutoRenewalResponse
	 */
	public function disableAutoRenewal(Commands\DisableAutoRenewalCommand $command) { return $this->execute($command); }

	/**
	 * @param Commands\DisableIdProtectionCommand $command
	 * @return Responses\DisableIdProtectionResponse
	 */
	public function disableIdProtection(Commands\DisableIdProtectionCommand $command) { return $this->execute($command); }

	/**
	 * @param Commands\DomainInfoCommand $command
	 * @return Responses\DomainInfoResponse
	 */
	public function domainInfo(Commands\DomainInfoCommand $command) { return $this->execute($command); }

	/**
	 * @param Commands\DomainRegisterAUCommand $command
	 * @return Responses\DomainRegisterAUResponse
	 */
	public function domainRegisterAu(Commands\DomainRegisterAUCommand $command) { return $this->execute($command); }

	/**
	 * @param Commands\DomainRegisterCommand $command
	 * @return Responses\DomainRegisterResponse
	 */
	public function domainRegister(Commands\DomainRegisterCommand $command) { return $this->execute($command); }

	/**
	 * @param Commands\DomainRegisterUKCommand $command
	 * @return Responses\DomainRegisterUKResponse
	 */
	public function domainRegisterUk(Commands\DomainRegisterUKCommand $command) { return $this->execute($command); }

	/**
	 * @param Commands\DomainRegisterUSCommand $command
	 * @return Responses\DomainRegisterUSResponse
	 */
	public function domainRegisterUs(Commands\DomainRegisterUSCommand $command) { return $this->execute($command); }

	/**
	 * @param Commands\DomainReleaseUKCommand $command
	 *
	 * @return Responses\DomainReleaseUKResponse
	 */
	public function domainReleaseUk(Commands\DomainReleaseUKCommand $command) { return $this->execute($command); }

	/**
	 * @param Commands\DomainTransferUKCommand $command
	 * @return Responses\DomainTransferUKResponse
	 */
	public function domainTransferUk(Commands\DomainTransferUKCommand $command) { return $this->execute($command); }

	/**
	 * @param Commands\EnableAutoRenewalCommand $command
	 * @return Responses\EnableAutoRenewalResponse
	 */
	public function enableAutoRenewal(Commands\EnableAutoRenewalCommand $command) { return $this->execute($command); }

	/**
	 * @param Commands\EnableIdProtectionCommand $command
	 * @return Responses\EnableIdProtectionResponse
	 */
	public function enableIdProtection(Commands\EnableIdProtectionCommand $command) { return $this->execute($command); }

	/**
	 * @param Commands\GetDomainExtensionOptionsCommand $command
	 * @return Responses\GetDomainExtensionOptionsResponse
	 */
	public function getDomainExtensionOptions(Commands\GetDomainExtensionOptionsCommand $command) { return $this->execute($command); }

	/**
	 * @param Commands\GetTransferredAwayDomainsCommand $command
	 * @return Responses\GetTransferredAwayDomainsResponse
	 */
	public function getTransferredAwayDomains(Commands\GetTransferredAwayDomainsCommand $command) { return $this->execute($command); }

	/**
	 * @param Commands\GetUsNexusDataCommand $command
	 * @return Responses\GetUsNexusDataResponse
	 */
	public function getUsNexusData(Commands\GetUsNexusDataCommand $command) { return $this->execute($command); }

	/**
	 * @param Commands\InitiateAuCorCommand $command
	 * @return Responses\InitiateAuCorResponse
	 */
	public function initiateAuCor(Commands\InitiateAuCorCommand $command) { return $this->execute($command); }

	/**
	 * @param Commands\ListContactsCommand $command
	 * @return Responses\ListContactsResponse
	 */
	public function listContacts(Commands\ListContactsCommand $command) { return $this->execute($command); }

	/**
	 * @param Commands\LockDomainCommand $command
	 * @return Responses\LockDomainResponse
	 */
	public function lockDomain(Commands\LockDomainCommand $command) { return $this->execute($command); }

	/**
	 * @param Commands\RenewDomainCommand $command
	 * @return Responses\RenewDomainResponse
	 */
	public function renewDomain(Commands\RenewDomainCommand $command) { return $this->execute($command); }

	/**
	 * @param Commands\ResendTransferEmailCommand $command
	 * @return Responses\ResendTransferEmailResponse
	 */
	public function resendTransferEmail(Commands\ResendTransferEmailCommand $command) { return $this->execute($command); }

	/**
	 * @param Commands\ResubmitFailedTransferCommand $command
	 * @return Responses\ResubmitFailedTransferResponse
	 */
	public function resubmitFailedTransfer(Commands\ResubmitFailedTransferCommand $command) { return $this->execute($command); }

	/**
	 * @param Commands\SendSMSCommand $command
	 * @return Responses\SendSMSResponse
	 */
	public function sendSMS(Commands\SendSMSCommand $command) { return $this->execute($command); }

	/**
	 * @param Commands\TransferDomainCommand $command
	 * @return Responses\TransferDomainResponse
	 */
	public function transferDomain(Commands\TransferDomainCommand $command) { return $this->execute($command); }

	/**
	 * @param Commands\UnlockDomainCommand $command
	 * @return Responses\UnlockDomainResponse
	 */
	public function unlockDomain(Commands\UnlockDomainCommand $command) { return $this->execute($command); }

	/**
	 * @param Commands\UpdateContactCommand $command
	 * @return Responses\UpdateContactResponse
	 */
	public function updateContact(Commands\UpdateContactCommand $command) { return $this->execute($command); }

	/**
	 * @param Commands\UpdateDomainPasswordCommand $command
	 * @return Responses\UpdateDomainPasswordResponse
	 */
	public function updateDomainPassword(Commands\UpdateDomainPasswordCommand $command) { return $this->execute($command); }

	/**
	 * @param Commands\UpdateNameServersCommand $command
	 * @return Responses\UpdateNameServersResponse
	 */
	public function updateNameServers(Commands\UpdateNameServersCommand $command) { return $this->execute($command); }


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
		$responseData = $this->objectToArray($response);
		if (isset($responseData['domainPassword'])) $responseData['domainPassword'] = "*****";
		$this->log('debug', "{$soapCommand} response", $responseData);
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
