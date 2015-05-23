<?php  namespace SynergyWholesale\Responses; 

use SynergyWholesale\Types\Bool;

class GetDomainExtensionOptionsResponse extends Response
{
	protected $expectedFields = array(
		'canRenew', 'canRenewWithin', 'cannotRenewAfter',
		'isIPV4Capable', 'isIPV6Capable',
		'isIDProtectCapable', 'transferLock', 'isHostsCapable',
		'minYears', 'maxYears'
	);

	public function canRenew()
	{
		return Bool::convert($this->response->canRenew);
	}

	public function canRenewWithin()
	{
		return intval($this->response->canRenewWithin);
	}

	public function cannotRenewAfter()
	{
		return intval($this->response->cannotRenewAfter);
	}

	public function isIpV4Capable()
	{
		return Bool::convert($this->response->isIPV4Capable);
	}

	public function isIpv6Capable()
	{
		return Bool::convert($this->response->isIPV6Capable);
	}

	public function isIdProtectCapable()
	{
		return Bool::convert($this->response->isIDProtectCapable);
	}

	public function transferLock()
	{
		return Bool::convert($this->response->transferLock);
	}

	public function isHostsCapable()
	{
		return Bool::convert($this->response->isHostsCapable);
	}

	public function getMinYears()
	{
		return intval($this->response->minYears);
	}

	public function getMaxYears()
	{
		return intval($this->response->maxYears);
	}
}
