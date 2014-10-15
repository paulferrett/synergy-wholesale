<?php  namespace SynergyWholesale\Commands;

use SynergyWholesale\Exception\InvalidArgumentException;
use SynergyWholesale\Types\Tld;

class GetDomainExtensionOptionsCommand implements Command
{
	/** @var string $tld */
	protected $tld;

	function __construct(Tld $tld)
	{
		$this->tld = $tld;
	}

	public function getRequestData()
	{
		return array('tld' => strval($this->tld));
	}
}

?>
 