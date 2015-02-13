Synergy Wholesale API Wrapper
=============================

A Synergy Wholesale API wrapper using SoapClient

By [Simon Hampel](http://hampelgroup.com/).

Installation
------------

The recommended way of installing the Synergy Wholesale Wrapper is through [Composer](http://getcomposer.org):

    :::json
    {
        "require": {
            "hampel/synergy-wholesale": "~1.0"
        }
    }

Note that if you intend to use this package with Laravel, we recommend installing the
[hampel/synergy-wholesale-laravel](https://packagist.org/packages/hampel/synergy-wholesale-laravel) package instead,
which provides a simple Laravel service provider and Facade for working with this API wrapper. The Laravel version
automatically links into the Laravel logging system as well, making it easy to keep track of issues with the API.

Usage
-----

You will need to turn on API access in your Synergy Wholesale control panel, which will tell you your Reseller ID. You
also need to add the IP address of your web server to the IP whitelist to enable an API key.

Specify the Reseller ID and API Key as parameters to the SynergyWholesle constructor.

You can optionally specify a logging implementation which uses the psr/log interface
(eg [Monolog](https://github.com/Seldaek/monolog)), which will enable the API calls and responses to be logged for
debugging and error tracking purposes.

This API wrapper provides a rich object-oriented interface to the API calls, using value objects to construct inputs
which provide granular validation of input data.

Raw responses from the API are stdClass objects containing public properties with the response values. This wrapper
processes and validates these responses and provides a richer interface for accessing the returned data.

Exceptions are thrown on errors.

__Long-hand Initialisation Example__

    :::php
    <?php
    // start by creating a SoapClient with the location of the WSDL file supplied by Synergy Wholesale
    $client = new SoapClient(null, array('location' => SynergyWholesale::WSDL_URL, 'uri' => ''));

    // create a Response generator (the engine which maps command objects to response objects)
    $responseGenerator = new \SynergyWholesale\BasicResponseGenerator();

    // now we can build our command execution engine, pass "null" for the logger if we don't have one
    $sw = new \SynergyWholesale\SynergyWholesale($client, $responseGenerator, null, "reseller_id", "api_key");

__Alternative Static Factory Example__

    :::php
    <?php
    // does all the heavy lifting for you if you don't need a logger
    $sw = \SynergyWholesale\SynergyWholesale::make("reseller_id", "api_key");

__Balance Query Command Example__

    :::php
    <?php
    // create a command object for the SynergyWholesale service to execute
    $command = new BalanceQueryCommand(); // no parameters required for this call!

    // execute the command
    try {
    	$response = $sw->execute($command);
    }
    catch (Exception $e) {
    	// different exceptions are thrown on different types of errors
    	// you can be as coarse or as granular as you like with error handling
    	exit("Error executing command: " . $e->getMessage());
    }

    echo "Account balance: " . $response->getBalance();

__Domain Information Command Example__

    :::php
    <?php

    // need to create a Domain object first
    try {
    	$domain = new \SynergyWholesale\Types\Domain('example.com');
    }
    catch (\SynergyWholesale\Exception\InvalidArgumentException $e) {
    	exit("Error building domain object: " . $e->getMessage());
    }

    // pass this as a parameter to the command
    $command = new DomainInfoCommand($domain);

    // execute the command
    try {
    	$response = $sw->execute($command);
    }
    catch (Exception $e) {
    	exit("Error executing command: " . $e->getMessage());
    }

    echo "

	// check availability of a domain for registration
	$command = new CheckDomainCommand('example.com');
	$response = $sw->execute($command);

	var_dump($response);

	?>

Notes
-----
 
Only the Domain Name and SMS API calls have been implemented

TODO: 

* Implement all the other calls to the SynergyWholesale API
