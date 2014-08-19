<?php  namespace SynergyWholesale\Responses;

class BalanceQueryResponse extends Response
{
	protected $expectedFields = array('balance');

	public function getBalance()
	{
		return $this->response->balance;
	}
}

?>
 