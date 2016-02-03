<?php  namespace SynergyWholesale\Commands;

use SynergyWholesale\Types\UkDomain;

class DomainReleaseUKCommand implements Command
{
	/** @var \SynergyWholesale\Types\UkDomain */
	protected $domain;

	/** @var string $tagName */
	protected $tagName;

	public function __construct(UkDomain $domain, $tagName)
	{
		$this->domain = $domain;
		$this->tagName = $tagName;
	}

	public function getRequestData()
	{
		return array(
			'domainName' => strval($this->domain),
			'tagName' => $this->tagName
		);
	}
}
