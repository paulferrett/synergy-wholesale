<?php  namespace SynergyWholesale\Responses;

use SynergyWholesale\Exception\BadDataException;

class SendSMSResponse extends Response
{
	protected $expectedFields = array('msgCount', 'perMsgCost', 'totalMsgCost');

	protected function validateData()
	{
		if (!is_numeric($this->response->msgCount))
		{
			throw new BadDataException("Expected a numeric msgCount");
		}

		if (!is_numeric($this->response->perMsgCost))
		{
			throw new BadDataException("Expected a numeric perMsgCost");
		}

		if (!is_numeric($this->response->totalMsgCost))
		{
			throw new BadDataException("Expected a numeric totalMsgCost");
		}
	}

	public function getMsgCount()
	{
		return $this->response->msgCount;
	}

	public function getPerMsgCost()
	{
		return $this->response->perMsgCost;
	}

	public function getTotalMsgCost()
	{
		return $this->response->totalMsgCost;
	}
}
