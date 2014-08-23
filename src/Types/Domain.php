<?php  namespace SynergyWholesale\Types; 

use Hampel\Validate\Validator;
use SynergyWholesale\Exception\InvalidArgumentException;

class Domain
{
	private $name;

	public function __construct($name)
	{
		$validator = new Validator();
		if (!$validator->isDomain($name, $validator->getTlds()))
		{
			throw new InvalidArgumentException("Invalid domain name [{$name}]");
		}

		$this->name = $name;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getTld()
	{
		$name = $this->getName();
		return substr($name, strpos($name, '.'));
	}

	public function getBaseName()
	{
		$name = $this->getName();
		return substr($name, 0, strpos($name, '.'));
	}

	public function isCcTld()
	{
		$tld = $this->getTld();
		return (substr_count($tld, '.') > 1);
	}

	public function __toString()
	{
		return $this->getName();
	}
}

?>
 