<?php  namespace SynergyWholesale\Commands;

use SynergyWholesale\Types\UkDomain;

class DomainReleaseUkCommand implements Command
{
	protected $domain;

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

?>
 