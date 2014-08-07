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
            "hampel/synergy-wholesale": "dev-master@dev"
        }
    }

Note that if you intend to use this package with Laravel, we recommend installing the
[hampel/synergy-wholesale-laravel](https://packagist.org/packages/hampel/synergy-wholesale-laravel) package instead,
which provides a simple Laravel service provider and Facade for working with this API wrapper.

Usage
-----

You will need to turn on API access in your Synergy Wholesale control panel, which will tell you your Reseller ID. You
will also need to add the IP address of your web server to the IP whitelist to enable an API key.

Specify the Reseller ID and API Key as parameters to the SynergyWholesle constructor.

All responses from the API wrapper are stdClass objects containing public properties with the response values.

Exceptions are thrown on errors.

    :::php
    <?php

	use Hampel\SynergyWholesale\SynergyWholesale;
	use Hampel\SynergyWholesale\Commands\BalanceQueryCommand;
	use Hampel\SynergyWholesale\Commands\DomainInfoCommand;
	use Hampel\SynergyWholesale\Commands\CheckDomainCommand;

	// long-hand initialisation method
	// start by creating a SoapClient with the location of the WSDL file supplied by Synergy Wholesale
	$client = new SoapClient(null, array('location' => 'https://api.synergywholesale.com/?wsdl', 'uri' => ''));
	$sw = new SynergyWholesale($client, "reseller_id", "api_key");

	// alternative static factory does all the heavy lifting for you
	$sw = SynergyWholesale::make("reseller_id", "api_key");

	// create a command object for the SynergyWholesale service to execute
	// in this case, a simple query to check your account balance
	$command = new BalanceQueryCommand();

	// execute the command
	$response = $sw->execute($command);

	var_dump($response);

	// get information about a domain
	$command = new DomainInfoCommand('example.com');
	$response = $sw->execute($command);

	var_dump($response);

	// check availability of a domain for registration
	$command = new CheckDomainCommand('example.com');
	$response = $sw->execute($command);

	var_dump($response);

	?>

Notes
-----
 
Only the following calls have been implemented so far:

* balanceQuery
* domainInfo
* checkDomain
* bulkcheckDomain
 
TODO: 

* Implement all the other calls to the SynergyWholesale API
