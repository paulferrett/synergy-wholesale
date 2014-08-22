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
		return substr($name, strrpos($name, '.') + 1);
	}

	public function getBaseName()
	{
		$name = $this->getName();
		return substr($name, 0, strrpos($name, '.'));
	}

	public function __toString()
	{
		return $this->getName();
	}
}

?>
 