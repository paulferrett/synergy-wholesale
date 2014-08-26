<?php  namespace SynergyWholesale\Types;

use Hampel\Validate\Validator;
use SynergyWholesale\Exception\InvalidArgumentException;

class UsDomain extends Domain
{
	public function __construct($name)
	{
		$validator = new Validator();
		if (!$validator->isDomain($name, array('us')))
		{
			throw new InvalidArgumentException("Invalid domain name [{$name}] - must be a .us domain");
		}

		parent::__construct($name);
	}
}

?>
 