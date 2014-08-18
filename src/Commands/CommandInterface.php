<?php namespace SynergyWholesale\Commands;

interface CommandInterface
{
	/**
	 * @return array    the array of key-value pairs to send for the command
	 */
	public function getRequestData();
}