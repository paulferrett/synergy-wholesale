<?php  namespace SynergyWholesale\Types;

class IcannStatus 
{
	const PENDING_VERIFICATION = 'PENDING_VERIFICATION';
	const PENDING_SUSPENSION = 'PENDING_SUSPENSION';
	const SUSPENDED = 'SUSPENDED';
	const VERIFIED = 'VERIFIED';
	const NOT_APPLICABLE = 'NOT_APPLICABLE';

	public static $descriptions = array(
		self::PENDING_VERIFICATION => 'The Registrant contact data is pending verification. The Registrant must click the specially encoded link that was sent to them via email in order to validate the Registrant WHOIS data',
		self::PENDING_SUSPENSION => 'The domain name has surpassed the allowed time for Registrant contact validation and the domain name is pending suspension (the clientHold status will be applied to the domain shortly',
		self::SUSPENDED => 'The domain name has surpassed the allowed time for Registrant contact validation and the clientHold status has been applied to the domain. As such, DNS resolution has been suspended and any webhosting or email services will be affected',
		self::VERIFIED => 'The Registrant WHOIS data has been validated and no further action is required',
		self::NA => 'The particular domain name is not subject to the ICANN Whois Data Verification ruleset and no action is required for Registrant contact validation'
	);

	public static $statusMap = array(
		'Pending Verification' => self::PENDING_VERIFICATION,
		'Pending Suspension' => self::PENDING_SUSPENSION,
		'Suspended' => self::SUSPENDED,
		'Verified' => self::VERIFIED,
		'N/A' => self::NOT_APPLICABLE,
	);


}

?>
 