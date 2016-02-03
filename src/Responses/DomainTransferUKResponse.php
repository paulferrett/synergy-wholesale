<?php namespace SynergyWholesale\Responses;

use SynergyWholesale\Exception\BadDataException;

class DomainTransferUKResponse extends Response
{
    protected $expectedFields = array('statusCode', 'reason');

    protected function validateData()
    {
        if (!is_numeric($this->response->statusCode))
        {
            throw new BadDataException("Expected a numeric status code");
        }
    }

    public function getStatusCode()
    {
        return $this->response->statusCode;
    }

    public function getReason()
    {
        return $this->response->reason;
    }

}
