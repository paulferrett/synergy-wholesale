<?php  namespace SynergyWholesale\Responses;

use SynergyWholesale\Exception\BadDataException;

class DomainRegisterAUResponse extends Response
{
	protected $expectedFields = array('costPrice');

	protected function validateData()
	{
		if (!is_numeric($this->response->costPrice))
		{
			throw new BadDataException("Expected a numeric cost price");
		}
	}

	public function getCostPrice()
	{
		return $this->response->costPrice;
	}
}
