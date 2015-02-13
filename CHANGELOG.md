CHANGELOG
=========

1.0.2 (2015-02-13)
------------------

* fix naming of determineSMSCostResponse file for case-insensitive platforms

1.0.1 (2015-02-13)
------------------

* fix naming of determineSMSCostCommand file for case-insensitive platforms
* rename determineSMSCost helper function for consistency

1.0.0 (2015-02-13)
------------------

* even though not feature complete yet, it's time to release a stable version

0.5.1 (2015-02-13)
------------------

* changed mockery requirement to use ^0.9, updated branch-alias

0.5.0 (2014-10-15)
------------------

* rename DeterminSmsCostCommand -> DetermineSMSCostCommand
* renamed helper function sendSms -> sendSMS to be consistent with class names and WSDL function name used by
  SynergyWholesale
* rename SendSms -> SendSMS (thanks to Alex <alex@serversaurus.com> for the PR)

0.4.0 (2014-10-15)
------------------

* update composer dev-master alias
* removed dependency on hampel/validate library and changed various types to do their own validation
* change dev-master branch alias to 0.3.x-dev

0.3.2 (2014-09-09)
------------------

* additional test for retrieving raw response data in ResponseTest
* slightly more meaningful error message for invalid phone numbers in class Phone
* handle empty name server arrays correctly in class DomainInfoResponse
* create the contacts at validation time and output meaningful errors for missing nested fields in class
  ListContactsResponse
* if no domains have been transferred away, then the domains field won't be set in class
  GetTransferredAwayDomainsResponse
* canRenewDomain might respond with a null valud for yearsCanRenewFor
* added Response::getErrorMessage function

0.3.1 (2014-08-31)
------------------

* added optional parameter 'state' back into BusinesCheckRegistrationResponse::getAuBusinessRegistration() for those
  cases where state is not returned in data

0.3.0 (2014-08-31)
------------------

* extra type hints in docblocks for DomainList
* clean up DomainListTest tests a bit
* rename class GetUsNexusData -> GetUsNexusDataCommand
* typehinted docblocks
* make $response and $command protected and add getters for them in Response class
* updated DomainInfoResponse type handling
* added wrapper functions for all command to SynergyWholesale class so we can typehint return values and get command
  completion in the IDE when using response classes

0.2.2 (2014-08-29)
------------------

* bug fixes in Domain and DomainInfoResponse

0.2.1 (2014-08-29)
------------------

* make the default api URL a const so can be accessed by external classes
* getter for the raw response data
* added branch-alias to composer.json

0.2.0 (2014-08-27)
------------------

### Fixes and Updates ###

* response data for BulkCheckDomainResponse actually contains an array of stdClass objects with data for each domain
* updates to CheckDomainCommand; added unit tests
* updates for BulkCheckDomainCommand, added unit tests
* added logging via psr/log
* some command responses use "OK" others use "ok" - updated Response base class to accept either
* updates to DomainInfoCommand and DomainInfoResponse
* refactoring; rebase exceptions and use exception interface for more granular exception handling
* refactor to remove Hampel\ from namespace, fixed broken unit tests
* rearchitected

### New Features ###

* implemented updateContact command
* implemented unlockDomain command
* implemented sendSMS command
* implemented resendVerificationEmail command
* implemented lockDomain command
* implemented listContacts command
* implemented initiateAUCOR command
* implemented getUSNexusData command
* implemented getTransferredAwayDomains command
* implemented getDomainExtensionOptions command
* implemented enableIDProtection command
* implemented enableAutoRenewal command
* implemented disableIDProtection command
* implemented disableAutoRenewal command
* implemented determineSMSCost command
* implemented canRenewDomain command
* implemented resubmitFailedTransfer command
* implemented resendTransferEmail command
* implemented renewDomain command
* implemented updateNameServers command
* implemented domainReleaseUK command
* implemented TransferDomain command
* implemented DomainTransferUk command
* implemented DomainRegisterUs command
* implemented DomainRegister command
* implemented DomainRegisterUk command
* implemented DomainRegisterAu command
* implemented updateDomainPassword command

* added RegistrationYears type
* added DomainList type
* added UsNexusCategory type
* added UsDomain type
* added UsAppPurpose type
* added UkDomain type
* added Bool type
* added AuBusinessRegistration type
* added AuRegistrant type
* added AuOrganisationType type
* added AuIdType type
* added Phone type
* added Contact type
* added Email type
* added AuPostCode type
* added Country type
* added AuState type
* added AuDomain type
* added AuContact type

0.1.0 (2014-08-06)
------------------

* fixes for SynergyWholesale::parseResponse ... will always have a status returned, but only an errorMessage if there was an error
* CheckDomainCommand, BulkCheckDomainCommand
* DomainInfoCommand
* initial release
