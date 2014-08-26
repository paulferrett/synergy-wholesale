<?php  namespace SynergyWholesale\Types; 

use Hampel\Validate\Validator;
use SynergyWholesale\Exception\InvalidArgumentException;

class AuDomain extends Domain
{
	public function __construct($name)
	{
		$validator = new Validator();
		if (!$validator->isDomain($name, array('au')))
		{
			throw new InvalidArgumentException("Invalid domain name [{$name}] - must be a .au domain");
		}

		parent::__construct($name);
	}
}

?>
 