<?php  namespace Hampel\SynergyWholesale\Responses;

use stdClass;
use Hampel\SynergyWholesale\Exception\ResponseErrorException;

class BalanceQueryResponse extends Response
{
	protected $expectedFields = array('balance');

	public function __construct(stdClass $response, $command)
	{
		if ($response->status != 'OK')
		{
			throw new ResponseErrorException($response, $command);
		}

		parent::__construct($response, $command);
	}

	public function getBalance()
	{
		return $this->response->balance;
	}
}

?>
 