<?php namespace SynergyWholesale\Commands;

use SynergyWholesale\Types\AuState;
use SynergyWholesale\Exception\CommandException;

class BusinessCheckRegistrationCommand implements Command
{
	protected $registrationNumber;

	protected $registrationState;

	public function __construct($registrationNumber, AuState $registrationState = null)
	{
		$this->resgistrationNumber = $registrationNumber;
		$this->registrationState = $registrationState;
	}

	public function getRequestData()
	{
		$data = array('registrationNumber' => $this->resgistrationNumber);

		if (isset($this->registrationState))
		{
			$data['registrationState'] = $this->registrationState->getState();
		}

		return $data;
	}
}

?>
