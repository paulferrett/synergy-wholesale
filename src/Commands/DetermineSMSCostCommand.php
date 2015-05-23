<?php  namespace SynergyWholesale\Commands; 

class DetermineSMSCostCommand implements Command
{
	/** @var string $destination */
	protected $destination;

	/** @var string $message */
	protected $message;

	function __construct($destination, $message)
	{
		$this->destination = $destination;
		$this->message = $message;
	}

	public function getRequestData()
	{
		return array(
			'destination' => $this->destination,
			'message' => $this->message
		);
	}
}
