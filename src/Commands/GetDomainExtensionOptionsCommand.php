<?php  namespace SynergyWholesale\Commands;

use Hampel\Validate\Validator;
use SynergyWholesale\Exception\InvalidArgumentException;

class GetDomainExtensionOptionsCommand implements Command
{
	/** @var string $tld */
	protected $tld;

	function __construct($tld)
	{
		$validator = new Validator();
		if (!$validator->isTld($tld, $validator->getTlds()))
		{
			throw new InvalidArgumentException("Invalid TLD [{$tld}]");
		}
		$this->tld = $tld;
	}

	public function getRequestData()
	{
		return array('tld' => $this->tld);
	}
}

?>
 