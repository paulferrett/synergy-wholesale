<?php  namespace SynergyWholesale\Types; 

use Hampel\Validate\Validator;
use SynergyWholesale\Exception\UnknownAuDomainException;

class AuDomain extends Domain
{
	public function __construct($name)
	{
		$validator = new Validator();
		if (!$validator->isDomain($name, array('au')))
		{
			throw new UnknownAuDomainException("Invalid domain name [{$name}] - must be a .au domain");
		}

		parent::__construct($name);
	}
}

?>
 