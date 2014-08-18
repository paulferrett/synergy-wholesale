<?php namespace SynergyWholesale\Exception;

class CommandException extends SynergyWholesaleException
{
	public function __construct($message = "")
	{
		parent::__construct($message);
	}
}

?>