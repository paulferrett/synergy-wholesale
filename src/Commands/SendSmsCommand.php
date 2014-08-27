<?php  namespace SynergyWholesale\Commands; 

class SendSmsCommand implements Command
{
	protected $destination;

	protected $senderId;

	protected $message;

	function __construct($destination, $senderId, $message)
	{
		$this->destination = $destination;
		$this->senderId = $senderId;
		$this->message = $message;
	}

	public function getRequestData()
	{
		return array(
			'destination' => $this->destination,
			'senderID' => $this->senderId,
			'message' => $this->message
		);
	}
}

?>
 