<?php namespace SynergyWholesale\Commands;

use SynergyWholesale\Exception\CommandException;

class BusinessCheckRegistrationCommand implements CommandInterface
{
	protected $registrationNumber;

	protected $registrationState;

	private $states = array('NSW', 'VIC', 'QLD', 'TAS', 'ACT', 'SA', 'WA', 'NT');

	public function __construct($registrationNumber, $registrationState = "")
	{
		$this->resgistrationNumber = $registrationNumber;

		if (!empty($registrationState))
		{
			$state = strtoupper($registrationState);
			if (!in_array($state, $this->states)) throw new CommandException("Invalid state [{$registrationState}]");
			$this->registrationState = $state;
		}
	}

	public function buildRequest()
	{
		return array(
			'registrationNumber' => $this->resgistrationNumber,
			'registrationState' => $this->registrationState
		);
	}
}

?>
