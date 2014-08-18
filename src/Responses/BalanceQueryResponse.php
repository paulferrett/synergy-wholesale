<?php  namespace Hampel\SynergyWholesale\Responses;

class BalanceQueryResponse extends Response
{
	protected $expectedFields = array('balance');

	public function validateData(){}

	public function getBalance()
	{
		return $this->response->balance;
	}
}

?>
 