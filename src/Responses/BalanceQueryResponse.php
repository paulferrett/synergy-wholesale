<?php  namespace SynergyWholesale\Responses;

class BalanceQueryResponse extends Response
{
	protected $expectedFields = array('balance');

	protected function validateData()
	{
		if (!is_numeric($this->response->balance))
		{
			throw new BadDataException("Expected a numeric account balance");
		}
	}

	public function getBalance()
	{
		return $this->response->balance;
	}
}
