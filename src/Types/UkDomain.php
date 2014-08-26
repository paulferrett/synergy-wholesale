<?php  namespace SynergyWholesale\Types;

use Hampel\Validate\Validator;
use SynergyWholesale\Exception\InvalidArgumentException;

class UkDomain extends Domain
{
	public function __construct($name)
	{
		$validator = new Validator();
		if (!$validator->isDomain($name, array('uk')))
		{
			throw new InvalidArgumentException("Invalid domain name [{$name}] - must be a .uk domain");
		}

		parent::__construct($name);
	}
}

?>
 