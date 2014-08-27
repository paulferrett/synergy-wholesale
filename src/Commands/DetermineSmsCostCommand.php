<?php  namespace SynergyWholesale\Commands; 

class DetermineSmsCostCommand implements Command
{
	protected $destination;

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

?>
 