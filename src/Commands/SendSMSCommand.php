<?php  namespace SynergyWholesale\Commands; 

class SendSMSCommand implements Command
{
	/** @var string */
	protected $destination;

	/** @var string */
	protected $senderId;

	/** @var string */
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
 
